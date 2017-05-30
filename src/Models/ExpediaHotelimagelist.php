<?php

namespace Galiasay\Expedia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpediaHotelimagelist
 *
 * @property int $EANHotelID
 * @property string $Caption
 * @property int $URL
 * @property int $Width
 * @property int $Height
 * @property int $ByteSize
 * @property string $ThumbnailURL
 * @property bool $DefaultImage
 */
class ExpediaHotelimagelist extends Model
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
    protected $primaryKey = 'URL';

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
        'Caption',
        'Width',
        'Height',
        'ByteSize',
        'ThumbnailURL',
        'DefaultImage'
    ];

    protected $casts = [
        'URL' => 'string'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('expedia.table_prefix') . 'hotelimagelist';
    }
}