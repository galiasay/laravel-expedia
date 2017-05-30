<?php

namespace Galiasay\Expedia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpediaPropertyattributelink
 *
 * @property int $EANHotelID
 * @property int $AttributeID
 * @property string $LanguageCode
 * @property string $AppendTxt
 */
class ExpediaPropertyattributelink extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

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
        'EANHotelID',
        'AttributeID',
        'LanguageCode',
        'AppendTxt'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('expedia.table_prefix') . 'propertyattributelink';
    }
}