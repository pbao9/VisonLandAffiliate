<?php

namespace App\Admin\Http\Resources\Article;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleSearchSelectResource extends JsonResource
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
            'text' => $this->title.' - '.$this->code.'-'.$this->operative_management
        ];
    }
}
