<?php

namespace Modules\Vehicles\Entities;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Common\Traits\JsonableOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Traits\UsesUuid;
use Modules\Orders\Entities\Delivery;
use Modules\Orders\Entities\Order;
use Modules\Vehicles\Database\factories\VehicleFactory;


/**
 * Modules\Vehicles\Entities\Vehicle
 *
 * @property-read Option $options_object
 * @method static VehicleFactory factory(...$parameters)
 * @method static Builder|Vehicle newModelQuery()
 * @method static Builder|Vehicle newQuery()
 * @method static Builder|Vehicle query()
 * @mixin Eloquent
 */
class Vehicle extends Model
{
    use HasFactory, JsonableOptions, UsesUuid;

    /**
     * Vehicle States
     */
    public const AVAILABLE = 'available';
    public const LOADING = 'loading';
    public const TRANSIT = 'transit';

    protected $fillable = [
        "registration",
        "make",
        "status",
        "vehicle_type_id",
        "options",
    ];

    /**
     * @var string[] $casts
     */
    protected $casts = [
        'options' => 'json'
    ];

    /**
     * @return VehicleFactory
     */
    protected static function newFactory()
    {
        return VehicleFactory::new();
    }

    /**
     * --------------------------------------------------------------------------
     * Relationships
     * --------------------------------------------------------------------------
     */

    /**
     * @return BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'deliveries');
    }

    /**
     * @return BelongsTo
     */
    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    /**
     * @return HasOne
     */
    public function deliveries(): HasOne
    {
        return $this->hasOne(Delivery::class);
    }
}
