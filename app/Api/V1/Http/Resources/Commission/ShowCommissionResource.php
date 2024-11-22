<?php

namespace App\Api\V1\Http\Resources\Commission;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Commission\CommissionRepositoryInterface;

class ShowCommissionResource extends JsonResource
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
            'indirect_commission_default' => $this ->indirect_commission_default,
            'direct_commission_default' => $this ->direct_commission_default,
                    
        ];
    }
}
