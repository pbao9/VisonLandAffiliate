<?php

namespace App\Api\V1\Http\Resources\HouseType;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\HouseType\HouseTypeRepositoryInterface;

class ShowHouseTypeResource extends JsonResource
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
            'name' => $this->name,
        ];
    }
}
