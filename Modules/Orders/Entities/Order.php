<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Common\Traits\JsonableOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Orders\Database\factories\OrderFactory;
use Modules\Vehicles\Entities\Vehicle;


class Order extends Model
{
    use HasFactory, JsonableOptions;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        "name",
        "status",
        "dispatched_at",
        "loaded_at",
        "delivered_at",
        "address",
        "depot_id",
        "options",
    ];

    /**
     * @var string[] $casts
     */
    protected $casts = [
        'options' => 'json'
    ];

    /**
     * @return OrderFactory
     */
    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }

    /**
     * --------------------------------------------------------------------------
     * Relationships
     * --------------------------------------------------------------------------
     */

    /**
     * @return BelongsToMany
     */
    public function vehicle(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class, 'deliveries');
    }
}
