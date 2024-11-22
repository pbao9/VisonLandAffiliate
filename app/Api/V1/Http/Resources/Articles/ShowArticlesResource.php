<?php

namespace App\Api\V1\Http\Resources\Articles;

use App\Enums\Article\ArticleType;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Articles\ArticlesRepositoryInterface;

class ShowArticlesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $images = is_iterable($this->image) ? (array) $this->image : [$this->image];

        $images = array_map(function ($image) {
            return $image ? asset($image) : null;
        }, $images);

        $owner_id = $this->getInfoAdmin() ?? $this->getInfoUser();

        return [
            'id' => $this->id,
            'owner' => $owner_id,
            'code' => $this->code,
            'type' => ArticleType::getDescription($this->type),
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'area' => $this->area,
            'price' => $this->price,
            'price_consent' => $this->price_consent,
            'quantity' => $this->quantity,
            'height_floor' => $this->height_floor,
            'project_size' => $this->project_size,
            'investor' => $this->investor,
            'constructor' => $this->constructor,
            'operative_management' => $this->operative_management,
            'hand_over' => $this->hand_over,
            'deployment_time' => $this->deployment_time,
            'building_density' => $this->building_density,
            'active_status' => $this->active_status,
            'utilities' => $this->utilities,
            'image' => $images,
            'name_contact' => $this->name_contact,
            'phone_contact' => $this->phone_contact,
            'status' => $this->status,
            'active_days' => $this->active_days,
            'time_start' => $this->time_start,
            'district' => $this->getNameDistrict(),
            'ward' => $this->getNameWard(),
            'province' => $this->getNameProvince(),
            'location' => $this->getTitleArea(),
            'houseType' => $this->getNameHouseType(),
        ];
    }
}
