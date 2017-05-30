<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpediaActivepropertybusinessmodelTable extends Migration
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * CreateExpediaActivepropertybusinessmodelTable constructor.
     */
    public function __construct()
    {
        $this->tableName = config('expedia.table_prefix') . 'activepropertybusinessmodel';
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
			$table->integer('EANHotelID')->primary();
			$table->integer('SequenceNumber')->nullable();
			$table->string('Name', 70)->nullable();
			$table->string('Address1', 50)->nullable();
			$table->string('Address2', 50)->nullable();
			$table->string('City', 50)->nullable();
			$table->string('StateProvince', 2)->nullable();
			$table->string('PostalCode', 15)->nullable();
			$table->string('Country', 2)->nullable();
			$table->decimal('Latitude', 8, 5)->nullable();
			$table->decimal('Longitude', 8, 5)->nullable();
			$table->string('AirportCode', 3)->nullable();
			$table->integer('PropertyCategory')->nullable();
			$table->string('PropertyCurrency', 3)->nullable();
			$table->decimal('StarRating', 2, 1)->nullable();
			$table->integer('Confidence')->nullable();
			$table->string('SupplierType', 3)->nullable();
			$table->string('Location', 80)->nullable();
			$table->integer('ChainCodeID')->nullable();
			$table->integer('RegionID')->nullable()->index('activemodel_regionid');
			$table->decimal('HighRate', 19, 4)->nullable();
			$table->decimal('LowRate', 19, 4)->nullable();
			$table->string('CheckInTime', 10)->nullable();
			$table->string('CheckOutTime', 10)->nullable();
			$table->integer('BusinessModelMask')->nullable();
			$table->index(['Latitude','Longitude'], 'activemodel_geoloc');
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
