<?php

namespace App\Api\V1\Http\Resources\Area;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllAreaResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($area) {

            return [
                'id' => $area->id,
                'name' => $area->name,
            ];
        });
    }
}
