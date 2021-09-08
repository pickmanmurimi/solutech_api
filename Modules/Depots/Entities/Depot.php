<?php

namespace Modules\Depots\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Traits\JsonableOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * Modules\Depots\Entities\Depot
 *
 * @property-read \Modules\Depots\Entities\Option $options_object
 * @method static \Modules\Depots\Database\factories\DepotFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Depot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Depot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Depot query()
 * @mixin \Eloquent
 */
class Depot extends Model
{
    use HasFactory, JsonableOptions;

    protected $fillable = [];

    /**
     * @var string[] $casts
     */
    protected $casts = [
        'options' => 'json'
    ];

    protected static function newFactory()
    {
        return \Modules\Depots\Database\factories\DepotFactory::new();
    }
}
