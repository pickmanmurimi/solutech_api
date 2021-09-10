<?php

namespace Modules\Vehicles\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Vehicles\Entities\VehicleType;

/**
 * @property mixed registration
 * @property mixed make
 * @property mixed status
 * @property mixed uuid
 * @property mixed created_at
 * @property mixed vehicleType
 */
class VehicleResource extends JsonResource
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
                "uuid" => $this->uuid,
                "registration" => $this->registration,
                "make" => $this->make,
                "status" => $this->status,
                "vehicle_type" => new VehicleTypeResource($this->vehicleType),
                'created_at' => $this->created_at,
                'created_at_readable' => $this->created_at->format('d M Y H:i:s'),
            ] : [];
    }
}
