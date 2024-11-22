<?php

namespace App\Api\V1\Http\Resources\Auth;

use App\Api\V1\Http\Resources\Bank\BankResource;
use App\Enums\CommissionDetail\CommissionDetailType;
use App\Enums\User\UserGender;
use App\Enums\User\UserRoles;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
            'code' => $this->code,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'avatar' => asset($this->avatar),
            'birthday' => $this->birthday,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => UserGender::getDescription($this->gender),
            'roles' => UserRoles::getDescription($this->roles),
            'bank_info' => BankResource::collection($this->whenLoaded('bank') ?? ''),
            'cccd_front_image' => asset($this->cccd_front_image),
            'cccd_back_image' => asset($this->cccd_back_image),
            'cccd_number' => $this->cccd_number,
            'issued_by' => $this->issued_by,
            'issued_day' => $this->issued_day,
            'created_at' => $this->created_at->format('d-m-Y'),
            'direct_commission' => $this->sumPaidAmountByType(CommissionDetailType::directCommission),
            'indirect_commission' => $this->sumPaidAmountByType(CommissionDetailType::inDirectCommission),
            'article_register' => $this->article_register->count(),
            'collaboration' => $this->collaboration->count(),
            'children_count' => $this->children->count(),
            'children' => ChildResource::collection($this->whenLoaded('children')),
        ];
    }
}
