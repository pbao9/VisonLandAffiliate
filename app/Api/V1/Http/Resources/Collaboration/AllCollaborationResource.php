<?php

namespace App\Api\V1\Http\Resources\Collaboration;

use App\Enums\Collaboration\Status;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllCollaborationResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($collaboration) {
            return [
                'id' => $collaboration->id,
                'article_id' => $collaboration->article_id,
                'title' => $collaboration->articles->title,
                'location' => $collaboration->articles->articleProvince->name . ', ' . $collaboration->articles->articleDistrict->name . ', ' . $collaboration->articles->articleWard->name,
                'status' => Status::getDescription($collaboration->status),
            ];
        });
    }
}
