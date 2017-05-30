<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpediaRoomtypelistTable extends Migration
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * CreateExpediaRoomtypelistTable constructor.
     */
    public function __construct()
    {
        $this->tableName = config('expedia.table_prefix') . 'roomtypelist';
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
			$table->integer('EANHotelID');
			$table->integer('RoomTypeID');
			$table->string('LanguageCode', 5)->nullable();
			$table->string('RoomTypeImage', 256)->nullable();
			$table->string('RoomTypeName', 200)->nullable();
			$table->text('RoomTypeDescription', 65535)->nullable();
			$table->primary(['EANHotelID','RoomTypeID']);
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
