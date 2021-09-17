<?php

namespace Modules\Orders\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Depots\Transformers\DepotResource;
use Modules\Orders\Entities\Order;
use Modules\Vehicles\Entities\Vehicle;
use Modules\Vehicles\Transformers\VehicleResource;

/**
 * @property mixed uuid
 * @property mixed name
 * @property mixed status
 * @property mixed dispatched_at
 * @property mixed loading_at
 * @property mixed delivered_at
 * @property mixed address
 * @property mixed depot
 * @property mixed created_at
 * @property mixed vehicle
 */
class OrderResource extends JsonResource
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
            "uuid" => $this->uuid,
            "name" => $this->name,
            "status" => $this->status,
            "vehicle" => new VehicleResource( optional($this->vehicle)->first() ),
            "dispatched_at" => optional($this->dispatched_at)->format('d M Y H:i:s'),
            "loading_at" => optional($this->loading_at)->format('d M Y H:i:s'),
            "delivered_at" => optional($this->delivered_at)->format('d M Y H:i:s'),
            "address" => $this->address,
            'created_at' => $this->created_at,
            'created_at_readable' => $this->created_at->format('d M Y H:i:s'),
            "depot" => new DepotResource( $this->depot ),
        ] : [];
    }
}
