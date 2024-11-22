<?php

namespace App\Api\V1\Http\Resources\ContactAdmin;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllContactAdminResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($contact_admin){
            
            return [
                'id' => $contact_admin->id,
                'admin_id' => $contact_admin->admin_id,
                    'fullname' => $contact_admin->fullname,
                    'phone' => $contact_admin->phone,
                    'referral_code' => $contact_admin->referral_code,
                    'status' => $contact_admin->status,
                    
            ];
            
        });
    }

    
}
