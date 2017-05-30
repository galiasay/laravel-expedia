<?php

namespace Galiasay\Expedia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpediaCountrylist
 *
 * @property int $CountryID
 * @property string $LanguageCode
 * @property string $CountryName
 * @property string $CountryCode
 * @property string $Transliteration
 * @property int $ContinentID
 */
class ExpediaCountrylist extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'CountryID';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'LanguageCode',
        'CountryName',
        'CountryCode',
        'Transliteration',
        'ContinentID'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('expedia.table_prefix') . 'countrylist';
    }
}