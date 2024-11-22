<?php

namespace App\Api\V1\Http\Resources\Collaboration;

use App\Enums\Collaboration\Status;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailCollaborationResource extends JsonResource
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
            'id' => $this->article_id,
            'title' => $this->articles->title,
            'location' => $this->articles->articleProvince->name . ', ' . $this->articles->articleDistrict->name . ', ' . $this->articles->articleWard->name,
            'status' => Status::getDescription($this->status),
            'info' => $this->getArticleRegistersCountByUserAndArticle($this->user_id, $this->article_id),
        ];
    }
}
