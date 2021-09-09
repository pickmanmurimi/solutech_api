<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Common\Traits\JsonableOptions;
use Modules\Common\Traits\UsesUuid;
use Modules\Vehicles\Entities\Vehicle;


class Delivery extends Model
{
    use JsonableOptions, UsesUuid;

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @var string[] $casts
     */
    protected $casts = [
        'options' => 'json'
    ];

    /**
     * --------------------------------------------------------------------------
     * Relationships
     * --------------------------------------------------------------------------
     */

    /**
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
    
    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo( Order::class );
    }
}
