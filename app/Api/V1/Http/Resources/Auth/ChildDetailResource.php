<?php

namespace App\Api\V1\Http\Resources\Auth;

use App\Api\V1\Http\Resources\Articles\AllArticlesResource;
use App\Api\V1\Http\Resources\Articles\ShowArticlesResource;
use App\Api\V1\Http\Resources\CustomerRegistrations\AllCustomerRegistrationsResource;
use App\Enums\CustomerRegistration\CustomerRegistrationStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildDetailResource extends JsonResource
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
            'info' => [
                'join_date' => $this->created_at->format('d-m-Y'),
                'identifier' => $this->checkIdentifier(),
                'article_register' => $this->article_register->count(),
            ],
            'article_collaboration' => $this->collaboration->map(function ($colab) {
                return [
                    'id' => $colab->articles->id,
                    'title' => $colab->articles->title,
                    'info' => $colab->getArticleRegistersCountByUserAndArticle($colab->user_id, $colab->article_id)
                ];
            }),
        ];
    }
}
