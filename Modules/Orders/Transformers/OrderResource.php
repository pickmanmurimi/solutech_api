<?php

namespace Modules\Orders\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Depots\Transformers\DepotResource;

/**
 * @property mixed uuid
 * @property mixed name
 * @property mixed status
 * @property mixed dispatched_at
 * @property mixed loaded_at
 * @property mixed delivered_at
 * @property mixed address
 * @property mixed depot
 * @property mixed created_at
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
            "dispatched_at" => $this->dispatched_at,
            "loaded_at" => $this->loaded_at,
            "delivered_at" => $this->delivered_at,
            "address" => $this->address,
            'created_at' => $this->created_at,
            'created_at_readable' => $this->created_at->format('d M Y H:i:s'),
            "depot" => new DepotResource( $this->depot ),
        ] : [];
    }
}
