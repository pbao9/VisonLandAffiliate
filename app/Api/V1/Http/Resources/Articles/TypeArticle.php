<?php

namespace App\Api\V1\Http\Resources\Articles;

use App\Enums\Article\ArticleType;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeArticle extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $status = ArticleType::asSelectArray();
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
