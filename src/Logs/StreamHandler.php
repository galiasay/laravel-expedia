<?php

namespace Galiasay\Expedia\Logs;

use Monolog\Handler\StreamHandler as Handler;
use Monolog\Logger;

/**
 * Class StreamHandler
 * @package Galiasay\Expedia\Logs
 */
class StreamHandler implements LogHandler
{
    /**
     * @return \Galiasay\Expedia\Logs\StreamHandler
     */
    public function createHandler()
    {
        return new Handler(storage_path('logs' . DIRECTORY_SEPARATOR . 'expedia_import.log', Logger::DEBUG));
    }
}