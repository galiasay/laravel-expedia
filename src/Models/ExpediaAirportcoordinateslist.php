<?php

namespace Galiasay\Expedia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpediaAirportcoordinateslist
 *
 * @property int $AirportID
 * @property int $AirportCode
 * @property string $AirportName
 * @property float $Latitude
 * @property float $Longitude
 * @property int $MainCityID
 * @property string $CountryCode
 */
class ExpediaAirportcoordinateslist extends Model
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
    protected $primaryKey = 'AirportCode';

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
        'AirportID',
        'AirportName',
        'Latitude',
        'Longitude',
        'MainCityID',
        'CountryCode'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('expedia.table_prefix') . 'airportcoordinateslist';
    }
}