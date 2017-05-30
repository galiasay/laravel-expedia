<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpediaLogActivepropertyChangesTable extends Migration
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * CreateExpediaLogActivepropertyChangesTable constructor.
     */
    public function __construct()
    {
        $this->tableName = config('expedia.table_prefix') . 'log_activeproperty_changes';
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
			$table->string('FieldName', 30)->nullable();
			$table->string('FieldType', 30)->nullable();
			$table->string('FieldValueOld', 80)->nullable();
			$table->string('FieldValueNew', 80)->nullable();
			$table->index(['EANHotelID','FieldName'], 'log_activeproperties');
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
