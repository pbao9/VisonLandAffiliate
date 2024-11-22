<?php

namespace App\Admin\Http\Requests\User;

use App\Admin\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\User\{UserRoles, UserVip, UserGender};

class UserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            // 'username' => [
            //     'required',
            //     'string', 'min:6', 'max:50',
            //     'unique:App\Models\User,username',
            //     'regex:/^[A-Za-z0-9_-]+$/',
            //     function ($attribute, $value, $fail) {
            //         if (in_array(strtolower($value), ['admin', 'user', 'password'])) {
            //             $fail('The '.$attribute.' cannot be a common keyword.');
            //         }
            //     },
            // ],
            'fullname' => ['required', 'string'],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\User,phone'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'address' => ['nullable'],
            'gender' => ['required', new EnumValue(UserGender::class, false)],
            'password' => ['required', 'string', 'confirmed'],
            'roles' => ['required', 'int'],
            'referal_code' => ['nullable'],
            'cccd_number' => ['nullable'],
            'cccd_front_image' => ['nullable'],
            'cccd_back_image' => ['nullable'],
            'issued_by' => ['nullable', 'string'],
            'issued_day' => ['nullable', 'string'],
            'avatar' => ['nullable'],
            'identifier' => ['nullable'],
            'birthday' => ['required', 'string']
            //            'vip' => ['required', new EnumValue(UserVip::class, false)]
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\User,id'],
            // 'username' => [
            //     'required',
            //     'string', 'min:6', 'max:50',
            //     'unique:App\Models\User,username,'.$this->id,
            //     'regex:/^[A-Za-z0-9_-]+$/',
            //     function ($attribute, $value, $fail) {
            //         if (in_array(strtolower($value), ['admin', 'user', 'password'])) {
            //             $fail('The '.$attribute.' cannot be a common keyword.');
            //         }
            //     },
            // ],
            'fullname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\User,email,' . $this->id],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\User,phone,' . $this->id],
            'address' => ['nullable'],
            'gender' => ['required', new EnumValue(UserGender::class, false)],
            'password' => ['nullable', 'string', 'confirmed'],
            'roles' => ['required', 'int'],
            'cccd_number' => ['required', 'string', 'regex:/^[0-9]{12}$/'],
            'cccd_front_image' => ['nullable'],
            'cccd_back_image' => ['nullable'],
            'issued_by' => ['required', 'string'],
            'active' => ['required'],
            'avatar' => ['nullable'],
            'identifier' => ['nullable'],
            'issued_day' => ['required', 'string'],
            'birthday' => ['required', 'string']
            //            'vip' => ['required', new EnumValue(UserVip::class, false)]
        ];
    }
}
