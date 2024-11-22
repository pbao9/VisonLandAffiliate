<?php

namespace App\Api\V1\Http\Resources\CommissionDetail;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\CommissionDetail\CommissionDetailRepositoryInterface;

class ShowCommissionDetailResource extends JsonResource
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
                'commission_id' => $this->commission_id,
                'articles_id' => $this->articles_id,
                'total_amount' => $this->total_amount,
                'amount_paid' => $this->amount_paid,
                'amount_percent' => $this->amount_percent,
                'status' => $this->status,    
        ];
    }
}
