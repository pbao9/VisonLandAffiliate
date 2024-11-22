<?php

namespace App\Admin\Http\Requests\Customers;

use App\Admin\Http\Requests\BaseRequest;

class CustomersRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'user_id' => ['required', 'integer'],
            'customer_name' => ['required', 'string'],
            'phone' => ['nullable', 'string'],
            'needs' => ['nullable', 'string'],
            'status' => ['nullable', 'int'],

        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Customers,id'],
            'user_id' => ['required', 'integer'],
            'customer_name' => ['required', 'string'],
            'phone' => ['nullable', 'string'],
            'needs' => ['nullable', 'string'],
            'status' => ['nullable', 'integer'],
        ];
    }
}
