<?php

namespace App\Api\V1\Http\Resources\CustomerRegistrations;

use App\Enums\CustomerRegistration\CustomerRegistrationStatus;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllCustomerRegistrationsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($customerRegistrations) {

            return [
                'id' => $customerRegistrations->id,
                'article' => [
                    'id' => $customerRegistrations->article_id,
                    'title' => $customerRegistrations->articles->title,
                    'location' => $customerRegistrations->articles->articleWard->name . ', ' .
                        $customerRegistrations->articles->articleDistrict->name . ', ' .
                        $customerRegistrations->articles->articleProvince->name,
                ],
                'user' => [
                    'fullname' => $customerRegistrations->users->fullname,
                    'phone' => $customerRegistrations->users->phone
                ],
                'info' => [
                    'fullname' => $customerRegistrations->fullname,
                    'phone' => $customerRegistrations->phone,
                    'needs' => $customerRegistrations->needs
                ],
                'status' => CustomerRegistrationStatus::getDescription($customerRegistrations->status),
                'registration_day' => $customerRegistrations->registration_day,
                'approval_day' => $customerRegistrations->approval_day,

            ];
        });
    }
}
