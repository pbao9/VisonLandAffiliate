<?php

namespace App\Api\V1\Http\Requests\Notification;

use App\Api\V1\Http\Requests\BaseRequest;

class NotificationRequest extends BaseRequest
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
            
            'user_id' => ['required', 'int'],
            'title' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'admin_id' => ['required', 'int'],
            'status' => ['nullable', 'int'],

        ];
    }
}
