<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpediaAirportcoordinateslistTable extends Migration
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * CreateExpediaAirportcoordinateslistTable constructor.
     */
    public function __construct()
    {
        $this->tableName = config('expedia.table_prefix') . 'airportcoordinateslist';
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
			$table->integer('AirportID');
			$table->string('AirportCode', 3)->primary();
			$table->string('AirportName', 250)->nullable()->index('idx_airportcoordinatelist_airportname');
			$table->decimal('Latitude', 9, 6)->nullable();
			$table->decimal('Longitude', 9, 6)->nullable();
			$table->integer('MainCityID')->nullable()->index('idx_airportcoordinatelist_maincityid');
			$table->string('CountryCode', 2)->nullable();
			$table->index(['Latitude','Longitude'], 'airportcoordinate_geoloc');
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
