<?php

namespace Modules\Vehicles\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed uuid
 * @property mixed name
 * @property mixed created_at
 */
class VehicleTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource ?
            [
                "id" => $this->id,
                "uuid" => $this->uuid,
                "name" => $this->name,
                'created_at' => $this->created_at,
                'created_at_readable' => $this->created_at->format('d M Y H:i:s'),
            ] : [];
    }
}
