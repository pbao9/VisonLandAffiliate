<?php

namespace App\Api\V1\Http\Resources\Articles;

use App\Enums\Article\ArticleStatus;
use App\Enums\Article\ArticleType;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllArticlesResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($articles) {
            $images = is_iterable($articles->image) ? (array) $articles->image : [$articles->image];

            $images = array_map(function ($image) {
                return $image ? asset($image) : null;
            }, $images);

            $owner_id = $articles->getInfoAdmin() ?? $articles->getInfoUser();

            return [
                'id' => $articles->id,
                'owner' => $owner_id,
                'type' => ArticleType::getDescription($articles->type),
                'title' => $articles->title,
                'investor' => $articles->investor,
                'description' => $articles->description,
                'area' => $articles->area,
                'price_level' => $articles->price,
                'image' => $images,
                'district' => $articles->getNameDistrict(),
                'ward' => $articles->getNameWard(),
                'province' => $articles->getNameProvince(),
                'location' => $articles->getTitleArea(),
                'houseType' => $articles->getNameHouseType(),
                'status' => $articles->status,
            ];
        });
    }
}
