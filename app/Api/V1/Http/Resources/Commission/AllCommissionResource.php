<?php

namespace App\Api\V1\Http\Resources\Commission;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllCommissionResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($commission){
            
            return [
                'id' => $commission->id,
                'indirect_commission_default' => $commission->indirect_commission_default,
                'direct_commission_default' => $commission->direct_commission_default,       
            ];
            
        });
    }

    
}
