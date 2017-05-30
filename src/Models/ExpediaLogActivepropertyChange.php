<?php

namespace Galiasay\Expedia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpediaLogActivepropertyChange
 *
 * @property int $EANHotelID
 * @property string $FieldName
 * @property string $FieldType
 * @property string $FieldValueOld
 * @property string $FieldValueNew
 */
class ExpediaLogActivepropertyChange extends Model
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
        'FieldName',
        'FieldType',
        'FieldValueOld',
        'FieldValueNew'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('expedia.table_prefix') . 'log_activeproperty_changes';
    }
}