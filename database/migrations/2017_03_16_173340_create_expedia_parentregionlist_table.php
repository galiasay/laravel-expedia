<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpediaParentregionlistTable extends Migration
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * CreateExpediaParentregionlistTable constructor.
     */
    public function __construct()
    {
        $this->tableName = config('expedia.table_prefix') . 'parentregionlist';
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
			$table->string('RegionType', 50)->nullable();
			$table->string('RelativeSignificance', 3)->nullable();
			$table->string('SubClass', 50)->nullable();
			$table->string('RegionName')->nullable();
			$table->string('RegionNameLong', 510)->nullable();
			$table->integer('ParentRegionID')->nullable()->index('idx_parentregionlist_parentid');
			$table->string('ParentRegionType', 50)->nullable();
			$table->string('ParentRegionName')->nullable();
			$table->string('ParentRegionNameLong', 510)->nullable();
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
