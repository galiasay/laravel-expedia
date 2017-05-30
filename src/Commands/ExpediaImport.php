<?php

namespace Galiasay\Expedia\Commands;

use Galiasay\Expedia\Exceptions\NotSupportedDriverException;
use Galiasay\Expedia\Logs\LogHandler;
use Galiasay\Expedia\Models\ExpediaHistoryImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\HandlerInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * Class ExpediaImport
 * @package Galiasay\Expedia\Commands
 */
class ExpediaImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expedia:import {--files= : List of the files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import database from Expedia';

    /**
     * Remote url to Expedia files.
     *
     * @var string
     */
    protected $remoteUrl;

    /**
     * @var mixed
     */
    protected $tablePrefix;

    /**
     * List of files.
     *
     * @var array
     */
    protected $files;

    /**
     * @var \Symfony\Component\Console\Helper\ProgressBar
     */
    protected $bar;

    /**
     * @var \Galiasay\Expedia\Logs\LogHandler
     */
    protected $logger;

    /**
     * @var
     */
    protected $tmpPath;

    /**
     * ExpediaImport constructor.
     *
     * @param \Galiasay\Expedia\Logs\LogHandler $logHandler
     * @param $tablePrefix
     * @param $remoteUrl
     */
    public function __construct(LogHandler $logHandler, $tablePrefix, $remoteUrl)
    {
        parent::__construct();

        $this->tablePrefix        = $tablePrefix;
        $this->remoteUrl          = $remoteUrl;
        $this->tmpPath            = env('TMP_PATH', sys_get_temp_dir());

        $this->initLogger($logHandler->createHandler());
    }

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle()
    {
        $this->initFiles();
        $this->initProgressBar();
        $this->createTmpDir();

        $result = [];
        foreach ($this->files as $file) {
            $this->bar->setMessage($file, 'filename');

            $records = 0;
            $fileName = $this->getFileName($file);

            try {
                if ($this->downloadFile($fileName) && $this->extractFile($fileName)) {
                    $records = $this->importDataFromFile($file);
                }
            } catch (\Exception $e) {
                $this->logger->error($e, ['file' => $file]);
                throw $e;
            }

            $result[] = compact('file', 'records');
            $this->bar->advance();
        }

        $this->removeTmpDir();
        $this->displayResult($result);
    }

    /**
     * Init progress bar.
     *
     * @return \Symfony\Component\Console\Helper\ProgressBar
     */
    protected function initProgressBar()
    {
        $this->bar = $this->output->createProgressBar(count($this->files));
        $this->bar->setFormatDefinition('custom', "%message% %filename%\n%current%/%max% [%bar%] %percent:3s%% %elapsed:6s% %memory:6s%\n");
        $this->bar->setFormat('custom');
        $this->bar->setBarWidth(100);
    }

    /**
     * Init logger.
     *
     * @param \Monolog\Handler\HandlerInterface $handler
     */
    protected function initLogger(HandlerInterface $handler)
    {
        $this->logger = Log::getMonolog();
        $this->logger->pushHandler($handler);
    }

    /**
     * Init files.
     *
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function initFiles()
    {
        $this->files = config('expedia.files');

        if ($this->hasOption('files')) {
            $files = explode(',', $this->option('files'));
            $filesCorrupt = array_diff($files, $this->files);

            if (count($filesCorrupt) > 0) {
                throw new InvalidArgumentException(sprintf('These files can not be initialized: %s.', implode(', ', $filesCorrupt)));
            }

            $this->files = array_intersect($files, $this->files);
        }
    }

    /**
     * @param $file
     * @return bool
     */
    protected function downloadFile($file)
    {
        $this->displayMessage('Downloading...');

        if ($handle = fopen($this->getFileUrl($file), 'r')) {
            file_put_contents($this->getTargetFilePath($file), $handle);
            fclose($handle);

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $file
     * @return bool
     */
    protected function extractFile($file)
    {
        $this->displayMessage('Extracting...');

        $zip = new \ZipArchive;
        if ($zip->open($this->getTargetFilePath($file))) {
            $zip->extractTo($this->getTargetPath());
            $zip->close();

            unlink($this->getTargetFilePath($file));

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $file
     * @return mixed
     * @throws \Galiasay\Expedia\Exceptions\NotSupportedDriverException
     */
    protected function importDataFromFile($file)
    {
        $this->displayMessage('Importing...');

        $table = $this->tablePrefix . strtolower($file);
        $fileName = $this->getFileName($file, 'txt');
        $from = $this->getTargetFilePath($fileName);

        DB::table($table)->truncate();

        $driver = DB::connection()->getDriverName();

        switch($driver) {
            case 'mysql':
                $query = sprintf("LOAD DATA LOCAL INFILE '%s' INTO TABLE %s 
                    CHARACTER SET utf8 FIELDS TERMINATED BY '|' IGNORE 1 LINES;", $from, $table);
                break;
            case 'psql':
                $query = sprintf("COPY %s FROM '%s' DELIMITER '|' CSV HEADER QUOTE '^'", $table, $from);
                break;
            default:
                throw new NotSupportedDriverException(sprintf('Driver %s is not supported.', $driver));
        }

        DB::connection()->getpdo()->exec($query);

        unlink($this->getTargetFilePath($fileName));

        return DB::table($table)->count();
    }

    /**
     * @param $message
     */
    protected function displayMessage($message)
    {
        $this->bar->setMessage($message);
        $this->bar->display();
    }

    /**
     * @param $result
     */
    protected function displayResult($result)
    {
        $this->bar->setMessage('Finish');
        $this->bar->setMessage('', 'filename');
        $this->bar->finish();

        $this->line('');
        $this->line('Result:');
        $this->table(['File', 'Records'], $result);
    }

    /**
     * @param $file
     * @return string
     */
    protected function getFileUrl($file)
    {
        return $this->remoteUrl . DIRECTORY_SEPARATOR . $file;
    }

    /**
     * @param $file
     * @param string $extension
     * @return string
     */
    protected function getFileName($file, $extension = 'zip')
    {
        return $file . '.' . $extension;
    }

    /**
     * @param $file
     * @return string
     */
    protected function getTargetFilePath($file)
    {
        return $this->getTargetPath() . DIRECTORY_SEPARATOR . $file;
    }

    /**
     * @return string
     */
    protected function getTargetPath()
    {
        return $this->tmpPath . DIRECTORY_SEPARATOR . 'expedia';
    }

    /**
     * Create dir in temporary folder.
     */
    protected function createTmpDir()
    {
        mkdir($this->getTargetPath());
    }

    /**
     * Remove dir from temporary folder.
     */
    protected function removeTmpDir()
    {
        rmdir($this->getTargetPath());
    }
}
