<?php

namespace App\Api\V1\Http\Requests\CustomerRegistrations;

use App\Api\V1\Http\Requests\BaseRequest;

class CustomerRegistrationsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet()
    {
        return [
            'page' => ['nullable', 'integer', 'min:1'],
            'limit' => ['nullable', 'integer', 'min:1']
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'user_id' => ['nullable', 'int'],
            'article_id' => ['required', 'int'],
            'fullname' => ['nullable', 'string'],
            'phone' => ['nullable', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
            'needs' => ['nullable', 'string'],
            'referal_code' => ['nullable', 'string'],
            'status' => ['nullable', 'int'],
            'registration_day' => ['nullable', 'string'],
            'approval_day' => ['nullable', 'string'],
        ];
    }
}
