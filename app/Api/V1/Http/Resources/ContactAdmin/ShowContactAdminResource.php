<?php

namespace App\Api\V1\Http\Resources\ContactAdmin;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\ContactAdmin\ContactAdminRepositoryInterface;

class ShowContactAdminResource extends JsonResource
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
            'admin_id' => $this ->admin_id,
                    'fullname' => $this ->fullname,
                    'phone' => $this ->phone,
                    'referral_code' => $this ->referral_code,
                    'status' => $this ->status,
                    
        ];
    }
}
