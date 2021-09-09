<?php

namespace Modules\Orders\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Vehicles\Transformers\VehicleResource;

/**
 * @property mixed order
 * @property mixed vehicle
 * @property mixed uuid
 * @property mixed created_at
 */
class DeliveryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource ? [
            'uuid' => $this->uuid,
            'order' => new OrderResource($this->order),
            'vehicle' => new VehicleResource($this->vehicle),
            'created_at' => $this->created_at,
            'created_at_readable' => $this->created_at->format('d M Y H:i:s'),
        ] : [];
    }
}
