<?php

namespace App\Api\V1\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use App\Api\V1\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\User\{UserVip, UserGender, UserRoles};

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'fullname' => ['required', 'string'],
            'referal_code' => ['nullable'],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\User,phone'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required', 'string', 'confirmed'],
        ];
    }
}
