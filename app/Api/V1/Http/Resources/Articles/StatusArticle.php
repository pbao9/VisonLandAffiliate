<?php

namespace App\Api\V1\Http\Resources\Articles;

use App\Enums\Article\ArticleArticleStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusArticle extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $status = ArticleArticleStatus::asSelectArray();
        $statusArray = [];
        foreach ($status as $key => $value) {
            $statusArray[] = [
                'key' => $key,
                'description' => $value,
            ];
        }
        return $statusArray;
    }
}
