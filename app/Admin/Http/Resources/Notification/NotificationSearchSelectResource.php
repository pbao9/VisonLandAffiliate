<?php

namespace App\Admin\Http\Resources\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationSearchSelectResource extends JsonResource
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
            'id' => $this->user_id,
            'text' => $this->fullname.' - '.$this->phone
        ];
    }
}
