<?php

namespace App\Admin\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class   CustomerSearchSelectResource extends JsonResource
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
            'text' => $this->customer_name.' - '.$this->phone
        ];
    }
}
