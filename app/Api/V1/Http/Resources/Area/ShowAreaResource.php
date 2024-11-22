<?php

namespace App\Api\V1\Http\Resources\Area;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Area\AreaRepositoryInterface;

class ShowAreaResource extends JsonResource
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
