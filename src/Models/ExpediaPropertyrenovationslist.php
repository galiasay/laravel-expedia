<?php

namespace Galiasay\Expedia\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpediaPropertyrenovationslist
 *
 * @property int $EANHotelID
 * @property string $LanguageCode
 * @property string $PropertyRenovationsDescription
 */
class ExpediaPropertyrenovationslist extends Model
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
        'LanguageCode',
        'PropertyRenovationsDescription'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('expedia.table_prefix') . 'propertyrenovationslist';
    }
}