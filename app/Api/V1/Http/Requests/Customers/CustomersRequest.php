<?php

namespace App\Api\V1\Http\Requests\Customers;

use App\Api\V1\Http\Requests\BaseRequest;

class CustomersRequest extends BaseRequest
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
            'limit' => ['nullable', 'integer', 'min:1'],
            'status' => ['nullable']
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
            'user_id' => ['nullable'],
            'article_id' => ['nullable'],
            'customer_name' => ['required', 'string'],
            'phone' => ['nullable', 'string'],
            'needs' => ['nullable', 'string'],
            'status' => ['nullable'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Customers,id'],
            'customer_name' => ['required', 'string'],
            'phone' => ['nullable', 'string'],
            'needs' => ['nullable', 'string'],
            'status' => ['nullable', 'nullable'],
        ];
    }
}
