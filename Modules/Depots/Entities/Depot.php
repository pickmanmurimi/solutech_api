<?php

namespace Modules\Depots\Entities;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Common\Traits\JsonableOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Traits\UsesUuid;
use Modules\Depots\Database\factories\DepotFactory;
use Modules\Orders\Entities\Order;


/**
 * Modules\Depots\Entities\Depot
 *
 * @property-read Option $options_object
 * @method static DepotFactory factory(...$parameters)
 * @method static Builder|Depot newModelQuery()
 * @method static Builder|Depot newQuery()
 * @method static Builder|Depot query()
 * @mixin Eloquent
 */
class Depot extends Model
{
    use HasFactory, JsonableOptions, UsesUuid;

    protected $fillable = [];

    /**
     * @var string[] $casts
     */
    protected $casts = [
        'options' => 'json'
    ];

    /**
     * @return DepotFactory
     */
    protected static function newFactory(): DepotFactory
    {
        return DepotFactory::new();
    }

    /**
     * --------------------------------------------------------------------------
     * Relationships
     * --------------------------------------------------------------------------
     */

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
