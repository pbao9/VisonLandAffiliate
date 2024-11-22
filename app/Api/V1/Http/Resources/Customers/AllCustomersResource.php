<?php

namespace App\Api\V1\Http\Resources\Customers;

use App\Enums\Customer\CustomerStatus;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllCustomersResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($customers) {

            return [
                'id' => $customers->id,
                'name' => $customers->customer_name,
                'phone' => $customers->phone,
                'needs' => $customers->needs,
                'status' => CustomerStatus::getDescription($customers->status),

            ];
        });
    }
}
