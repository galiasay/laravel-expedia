<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpediaPointsofinterestcoordinateslistTable extends Migration
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * CreateExpediaPointsofinterestcoordinateslistTable constructor.
     */
    public function __construct()
    {
        $this->tableName = config('expedia.table_prefix') . 'pointsofinterestcoordinateslist';
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
			$table->integer('RegionID')->index('idx_pointsofinterestcoordinateslist_regionid');
			$table->string('RegionName')->nullable();
			$table->string('RegionNameLong', 191)->default('')->primary();
			$table->decimal('Latitude', 9, 6)->nullable();
			$table->decimal('Longitude', 9, 6)->nullable();
			$table->string('SubClassification', 20)->nullable();
			$table->index(['Latitude','Longitude'], 'idx_poi__geoloc');
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
