<?php

namespace App\Admin\Http\Requests\Bank_Information;

use App\Http\Requests\BaseRequest;

class BankInformationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\BankInformation,id'],
            'bank_name' => ['required', 'string'],
            'bank_branch' => ['required', 'string'],
            'bank_account' => ['required', 'string'],
            'bank_number' => ['required', 'string'],
            'id_user' => ['required']
        ];
    }
    protected function methodPost()
    {
        return [
            'bank_name' => ['Required', 'string'],
            'bank_branch' => ['required', 'string'],
            'bank_account' => ['required', 'string'],
            'bank_number' => ['required'],
            'id_user' => ['required']
        ];
    }
}
