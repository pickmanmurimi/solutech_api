<?php

namespace Modules\Depots\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed uuid
 * @property mixed name
 * @property mixed address
 * @property mixed created_at
 */
class DepotResource extends JsonResource
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
            "address" => $this->address,
            'created_at' => $this->created_at,
            'created_at_readable' => $this->created_at->format('d M Y H:i:s'),
        ] : [];
    }
}
