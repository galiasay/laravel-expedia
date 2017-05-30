<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpediaPropertyattributelinkTable extends Migration
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * CreateExpediaPropertyattributelinkTable constructor.
     */
    public function __construct()
    {
        $this->tableName = config('expedia.table_prefix') . 'propertyattributelink';
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
			$table->integer('AttributeID');
			$table->string('LanguageCode', 5)->nullable();
			$table->string('AppendTxt', 191)->nullable();
			$table->primary(['EANHotelID','AttributeID']);
			$table->index(['AttributeID','EANHotelID'], 'idx_propertyattributelink_reverse');
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
