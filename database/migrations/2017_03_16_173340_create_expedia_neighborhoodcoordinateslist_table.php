<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpediaNeighborhoodcoordinateslistTable extends Migration
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * CreateExpediaNeighborhoodcoordinateslistTable constructor.
     */
    public function __construct()
    {
        $this->tableName = config('expedia.table_prefix') . 'neighborhoodcoordinateslist';
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
			$table->integer('RegionID')->primary();
			$table->string('RegionName')->nullable();
			$table->text('Coordinates', 65535)->nullable();
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
