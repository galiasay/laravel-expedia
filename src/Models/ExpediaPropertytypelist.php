<?php

namespace Galiasay\Expedia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpediaPropertytypelist
 *
 * @property int $PropertyCategory
 * @property string $LanguageCode
 * @property string $PropertyCategoryDesc
 */
class ExpediaPropertytypelist extends Model
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
    protected $primaryKey = 'PropertyCategory';

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
        'PropertyCategoryDesc'
    ];

    /**
     * @var array
     */
    protected $generalList = [1, 5, 6, 8, 16];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('expedia.table_prefix') . 'propertytypelist';
    }

    /**
     * @return array
     */
    public function isGeneral()
    {
        return in_array($this->PropertyCategory, $this->generalList);
    }
}