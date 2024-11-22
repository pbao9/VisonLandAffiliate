<?php

namespace App\Api\V1\Http\Requests\ContactAdmin;

use App\Api\V1\Http\Requests\BaseRequest;

class ContactAdminRequest extends BaseRequest
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
            'admin_id' => ['required', 'int'],
                    'fullname' => ['required', 'string'],
                    'phone' => ['required', 'string'],
                    'referral_code' => ['required', 'string'],
                    'status' => ['nullable', 'int'],
                    
        ];
    }
}