<?php

namespace App\Api\V1\Http\Resources\Notification;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Notification\NotificationRepositoryInterface;

class ShowNotificationResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'admin' => $this->getAdmin(),
        ];
    }
}
