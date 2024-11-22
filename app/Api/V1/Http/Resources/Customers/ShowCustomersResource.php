<?php

namespace App\Api\V1\Http\Resources\Customers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Customers\CustomersRepositoryInterface;
use App\Enums\Customer\CustomerStatus;

class ShowCustomersResource extends JsonResource
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
            'name' => $this->customer_name,
            'phone' => $this->phone,
            'needs' => $this->needs,
            'status' => CustomerStatus::getDescription($this->status),
        ];
    }
}
