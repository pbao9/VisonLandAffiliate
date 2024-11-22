<?php

namespace App\Api\V1\Http\Resources\CommissionDetail;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllCommissionDetailResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($commission_detail){
            
            return [
                'id' => $commission_detail->id,
                'commission_id' => $commission_detail->commission_id,
                'articles_id' => $commission_detail->articles_id,
                'total_amount' => $commission_detail->total_amount,
                'amount_paid' => $commission_detail->amount_paid,
                'amount_percent' => $commission_detail->amount_percent,
                'status' => $commission_detail->status,   
            ];
            
        });
    }

    
}
