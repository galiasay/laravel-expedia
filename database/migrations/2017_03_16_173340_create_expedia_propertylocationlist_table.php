<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpediaPropertylocationlistTable extends Migration
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * CreateExpediaPropertylocationlistTable constructor.
     */
    public function __construct()
    {
        $this->tableName = config('expedia.table_prefix') . 'propertylocationlist';
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
			$table->text('PropertyLocationDescription', 65535)->nullable();
//			$table->timestamp('TimeStamp')->default(DB::raw('CURRENT_TIMESTAMP'));
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
