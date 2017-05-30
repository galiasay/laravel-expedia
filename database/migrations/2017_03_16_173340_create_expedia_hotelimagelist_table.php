<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpediaHotelimagelistTable extends Migration
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * CreateExpediaHotelimagelistTable constructor.
     */
    public function __construct()
    {
        $this->tableName = config('expedia.table_prefix') . 'hotelimagelist';
    }
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->tableName, function(Blueprint $table)
		{
			$table->integer('EANHotelID')->index('idx_hotelimagelist_eanhotelid');
			$table->string('Caption', 70)->nullable();
			$table->string('URL', 150)->primary();
			$table->integer('Width')->nullable();
			$table->integer('Height')->nullable();
			$table->integer('ByteSize')->nullable();
			$table->string('ThumbnailURL', 300)->nullable();
			$table->boolean('DefaultImage')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop($this->tableName);
	}

}
