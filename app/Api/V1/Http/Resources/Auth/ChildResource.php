<?php

namespace App\Api\V1\Http\Resources\Auth;

use App\Enums\CustomerRegistration\CustomerRegistrationStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildResource extends JsonResource
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
            'fullname' => $this->fullname,
            'join_date' => $this->created_at->format('d-m-Y'),
            'identifier' => $this->checkIdentifier(),
            'article_register' => $this->article_register->count()
        ];
    }
}
