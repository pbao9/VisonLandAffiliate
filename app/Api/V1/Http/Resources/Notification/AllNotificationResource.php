<?php

namespace App\Api\V1\Http\Resources\Notification;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllNotificationResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($notification) {

            return [
                'id' => $notification->id,
                'user_id' => $notification->user_id,
                'title' => $notification->title,
                'content' => $notification->content,
                'admin_id' => $notification->admin_id,
                'status' => $notification->status,

            ];
        });
    }
}
