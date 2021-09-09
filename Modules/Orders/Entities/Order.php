<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Common\Traits\JsonableOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Traits\UsesUuid;
use Modules\Depots\Entities\Depot;
use Modules\Orders\Database\factories\OrderFactory;
use Modules\Vehicles\Entities\Vehicle;


class Order extends Model
{
    /**
     * Order States
     */
    public const PENDING = 'pending';
    public const LOADING = 'loading';
    public const DISPATCH = 'dispatched';
    public const DELIVERED = 'delivered';

    use HasFactory, JsonableOptions, UsesUuid;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        "name",
        "status",
        "dispatched_at",
        "loading_at",
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

    /**
     * @return BelongsTo
     */
    public function depot(): BelongsTo
    {
        return $this->belongsTo(Depot::class);
    }

    /**
     * @return HasOne
     */
    public function deliveries(): HasOne
    {
        return $this->hasOne(Delivery::class);
    }
}
