<?php

namespace Galiasay\Expedia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpediaActivepropertylist
 *
 * @property int $EANHotelID
 * @property int $SequenceNumber
 * @property string $Name
 * @property string $Address1
 * @property string $Address2
 * @property string $City
 * @property string $StateProvince
 * @property string $PostalCode
 * @property string $Country
 * @property float $Latitude
 * @property float $Longitude
 * @property string $AirportCode
 * @property int $PropertyCategory
 * @property string $PropertyCurrency
 * @property float $StarRating
 * @property int $Confidence
 * @property string $SupplierType
 * @property string $Location
 * @property int $ChainCodeID
 * @property int $RegionID
 * @property float $HighRate
 * @property float $LowRate
 * @property string $CheckInTime
 * @property string $CheckOutTime
 */
class ExpediaActivepropertylist extends Model
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
    protected $primaryKey = 'EANHotelID';

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
        'SequenceNumber',
        'Name',
        'Address1',
        'Address2',
        'City',
        'StateProvince',
        'PostalCode',
        'Country',
        'Latitude',
        'Longitude',
        'AirportCode',
        'PropertyCategory',
        'PropertyCurrency',
        'StarRating',
        'Confidence',
        'SupplierType',
        'Location',
        'ChainCodeID',
        'RegionID',
        'HighRate',
        'LowRate',
        'CheckInTime',
        'CheckOutTime',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public $casts = [
        'StarRating' => 'int',
        'Latitude' => 'float',
        'Longitude' => 'float',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('expedia.table_prefix') . 'activepropertylist';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function regions()
    {
        return $this->belongsToMany(
            ExpediaRegioncentercoordinateslist::class,
            (new ExpediaRegioneanhotelidmapping())->getTable(),
            'EANHotelID',
            'RegionID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes()
    {
        return $this->belongsToMany(
            ExpediaAttributelist::class,
            (new ExpediaPropertyattributelink())->getTable(),
            'EANHotelID',
            'AttributeID')->withPivot('AppendTxt');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function description()
    {
        return $this->hasOne(
            ExpediaPropertydescriptionlist::class,
            'EANHotelID',
            'EANHotelID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(
            ExpediaHotelimagelist::class,
            'EANHotelID',
            'EANHotelID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function locationDescription()
    {
        return $this->hasOne(
            ExpediaPropertylocationlist::class,
            'EANHotelID',
            'EANHotelID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function businessDescription()
    {
        return $this->hasOne(
            ExpediaPropertybusinessamenitieslist::class,
            'EANHotelID',
            'EANHotelID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function diningDescription()
    {
        return $this->hasOne(
            ExpediaDiningdescriptionlist::class,
            'EANHotelID',
            'EANHotelID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function roomsDescription()
    {
        return $this->hasOne(
            ExpediaPropertyroomslist::class,
            'EANHotelID',
            'EANHotelID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function amenitiesDescription()
    {
        return $this->hasOne(
            ExpediaPropertyamenitieslist::class,
            'EANHotelID',
            'EANHotelID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(
            ExpediaPropertytypelist::class,
                'PropertyCategory',
                'PropertyCategory');
    }

    public function mapping()
    {
        return $this->hasOne(
            ExpediaRegioneanhotelidmapping::class,
            'EANHotelID',
            'EANHotelID');
    }
}