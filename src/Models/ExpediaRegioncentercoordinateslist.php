<?php

namespace Galiasay\Expedia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpediaRegioncentercoordinateslist
 *
 * @property int $RegionID
 * @property string $RegionName
 * @property float $CenterLatitude
 * @property float $CenterLongitude
 */
class ExpediaRegioncentercoordinateslist extends Model
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
    protected $primaryKey = 'RegionID';

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
        'RegionName',
        'CenterLatitude',
        'CenterLongitude'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'CenterLatitude' => 'float',
        'CenterLongitude' => 'float',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('expedia.table_prefix') . 'regioncentercoordinateslist';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hotels()
    {
        return $this->belongsToMany(
            ExpediaActivepropertylist::class,
            (new ExpediaRegioneanhotelidmapping)->getTable(),
            'RegionID',
            'EANHotelID');
    }
}