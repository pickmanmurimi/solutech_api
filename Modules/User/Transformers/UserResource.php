<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed uuid
 * @property mixed name
 * @property mixed email
 * @property mixed email_verified_at
 * @property mixed created_at
 */
class UserResource extends JsonResource
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
                "name" => $this->name,
                "email" => $this->email,
                "email_verified_at" => $this->email_verified_at,
                'created_at' => $this->created_at,
                'created_at_readable' => $this->created_at->format('d M Y H:i:s'),
            ] : [];
    }
}
