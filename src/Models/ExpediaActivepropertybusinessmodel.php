<?php

namespace Galiasay\Expedia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpediaActivepropertybusinessmodel
 *
 * @property int $id
 * @property float $percent
 * @property int $total
 * @property string $status
 * @property mixed $details
 * @property string $created_at
 * @property string $updated_at
 */
class ExpediaActivepropertybusinessmodel extends Model
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
        'BusinessModelMask'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('expedia.table_prefix') . 'activepropertybusinessmodel';
    }

        
}