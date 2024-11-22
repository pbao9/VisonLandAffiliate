<?php

namespace App\Api\V1\Http\Resources\Address\Ward;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllWardResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($ward) {

            return [
                'id' => $ward->id,
                'name' => $ward->name,
            ];
        });
    }
}
