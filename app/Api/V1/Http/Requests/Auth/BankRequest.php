<?php

namespace App\Api\V1\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use App\Api\V1\Http\Requests\BaseRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\User\{UserVip, UserGender, UserRoles};

class BankRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'bank_name' => ['required', 'string'],
            'bank_branch' => ['required', 'string'],
            'bank_account' => ['required', 'string'],
            'bank_number' => ['required'],
            'id_user' => ['nullable']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\BankInformation,id'],
            'bank_name' => ['required', 'string'],
            'bank_branch' => ['required', 'string'],
            'bank_account' => ['required', 'string'],
            'bank_number' => ['required', 'string'],
            'id_user' => ['nullable']
        ];
    }
}
