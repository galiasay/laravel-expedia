<?php

namespace Galiasay\Expedia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpediaRoomtypelist
 *
 * @property int $EANHotelID
 * @property int $RoomTypeID
 * @property string $LanguageCode
 * @property string $RoomTypeImage
 * @property string $RoomTypeName
 * @property string $RoomTypeDescription
 */
class ExpediaRoomtypelist extends Model
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
        'RoomTypeID',
        'LanguageCode',
        'RoomTypeImage',
        'RoomTypeName',
        'RoomTypeDescription'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('expedia.table_prefix') . 'roomtypelist';
    }
}