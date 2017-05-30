<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpediaRegioneanhotelidmappingTable extends Migration
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * CreateExpediaRegioneanhotelidmappingTable constructor.
     */
    public function __construct()
    {
        $this->tableName = config('expedia.table_prefix') . 'regioneanhotelidmapping';
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
			$table->bigInteger('RegionID');
			$table->integer('EANHotelID');
			$table->primary(['RegionID','EANHotelID']);
			$table->index(['EANHotelID','RegionID'], 'idx_hotelidmapping_reverse');
            $table->foreign('RegionID')->references('RegionID')->on(config('expedia.table_prefix') . 'regioncentercoordinateslist')->onDelete('cascade');
            $table->foreign('EANHotelID')->references('EANHotelID')->on(config('expedia.table_prefix') . 'activepropertylist')->onDelete('cascade');
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
