<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpediaPolicydescriptionlistTable extends Migration
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * CreateExpediaPolicydescriptionlistTable constructor.
     */
    public function __construct()
    {
        $this->tableName = config('expedia.table_prefix') . 'policydescriptionlist';
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
			$table->string('LanguageCode', 5)->nullable();
			$table->text('PolicyDescription', 65535)->nullable();
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
