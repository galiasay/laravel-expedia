<?php

namespace Galiasay\Expedia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpediaParentregionlist
 *
 * @property int $RegionID
 * @property string $RegionType
 * @property string $RelativeSignificance
 * @property string $SubClass
 * @property string $RegionName
 * @property string $RegionNameLong
 * @property int $ParentRegionID
 * @property string $ParentRegionType
 * @property string $ParentRegionName
 * @property string $ParentRegionNameLong
 */
class ExpediaParentregionlist extends Model
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
        'RegionType',
        'RelativeSignificance',
        'SubClass',
        'RegionName',
        'RegionNameLong',
        'ParentRegionID',
        'ParentRegionType',
        'ParentRegionName',
        'ParentRegionNameLong'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('expedia.table_prefix') . 'parentregionlist';
    }
}