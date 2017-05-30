<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpediaCountrylistTable extends Migration
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * CreateExpediaCountrylistTable constructor.
     */
    public function __construct()
    {
        $this->tableName = config('expedia.table_prefix') . 'countrylist';
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
			$table->integer('CountryID')->primary();
			$table->string('LanguageCode', 5)->nullable();
			$table->string('CountryName', 250)->nullable()->unique('idx_countrylist_countryname');
			$table->string('CountryCode', 2)->unique('idx_countrylist_countrycode');
			$table->string('Transliteration', 256)->nullable();
			$table->integer('ContinentID')->nullable();
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
