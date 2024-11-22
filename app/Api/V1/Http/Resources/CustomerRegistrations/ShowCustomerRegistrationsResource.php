<?php

namespace App\Api\V1\Http\Resources\CustomerRegistrations;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\CustomerRegistrations\CustomerRegistrationsRepositoryInterface;

class ShowCustomerRegistrationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'article_id' => $this->article_id,
            'status' => $this->status,
            'registration_day' => $this->registration_day,
            'approval_day' => $this->approval_day,

        ];
    }
}
