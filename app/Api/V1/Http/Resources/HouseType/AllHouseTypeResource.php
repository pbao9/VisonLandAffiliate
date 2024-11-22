<?php

namespace App\Api\V1\Http\Resources\HouseType;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllHouseTypeResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($houseTypes) {

            return [
                'id' => $houseTypes->id,
                'name' => $houseTypes->name,
            ];
        });
    }
}
