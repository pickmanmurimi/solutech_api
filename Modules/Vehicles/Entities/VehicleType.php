<?php

namespace Modules\Vehicles\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Common\Traits\JsonableOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Traits\UsesUuid;
use Modules\Vehicles\Database\factories\VehicleTypeFactory;


class VehicleType extends Model
{
    use HasFactory, JsonableOptions, UsesUuid;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @var string[] $casts
     */
    protected $casts = [
        'options' => 'json'
    ];

    /**
     * @return VehicleTypeFactory
     */
    protected static function newFactory(): VehicleTypeFactory
    {
        return VehicleTypeFactory::new();
    }


    /**
     * --------------------------------------------------------------------------
     * Relationships
     * --------------------------------------------------------------------------
     */

    /**
     * @return HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
