<?php

namespace App\Admin\Http\Requests\SupperAdminSettings;

use App\Admin\Http\Requests\BaseRequest;

class SupperAdminSettingsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'bank_account_number' => ['nullable', 'string'],
            'transfer_syntax' => ['required', 'string'],
            'zalo_number' => ['required', 'string'],
            'hotline' => ['required', 'string'],
            'max_user_level' => ['required', 'int'],
            'commission_per_level' => ['required', 'int'],

        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\SupperAdminSettings,id'],
            'bank_account_number' => ['nullable', 'string'],
            'transfer_syntax' => ['required', 'string'],
            'zalo_number' => ['required', 'string'],
            'hotline' => ['required', 'string'],
            'max_user_level' => ['required', 'int'],
            'commission_per_level' => ['required', 'int'],

        ];
    }
}
