<?php

namespace App\Api\V1\Http\Resources\Setting;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Repositories\Setting\SettingRepositoryInterface;

class ShowSupperAdmin_settingsResource extends JsonResource
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
            'bank_account_number' => $this ->bank_account_number,
                    'transfer_syntax' => $this ->transfer_syntax,
                    'zalo_number' => $this ->zalo_number,
                    'hotline' => $this ->hotline,
                    'max_user_level' => $this ->max_user_level,
                    'commission_per_level' => $this ->commission_per_level,

        ];
    }
}
