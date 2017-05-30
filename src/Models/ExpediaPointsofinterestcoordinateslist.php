<?php

namespace Galiasay\Expedia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpediaPointsofinterestcoordinateslist
 *
 * @property int $RegionID
 * @property string $RegionName
 * @property int $RegionNameLong
 * @property float $Latitude
 * @property float $Longitude
 * @property string $SubClassification
 */
class ExpediaPointsofinterestcoordinateslist extends Model
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
    protected $primaryKey = 'RegionNameLong';

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
        'RegionID',
        'RegionName',
        'Latitude',
        'Longitude',
        'SubClassification'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('expedia.table_prefix') . 'pointsofinterestcoordinateslist';
    }
}