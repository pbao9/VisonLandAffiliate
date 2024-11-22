<?php

namespace App\Api\V1\Http\Requests\Collaboration;

use App\Api\V1\Http\Requests\BaseRequest;

class CollaborationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet()
    {
        return [
            'id' => ['nullable'],
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
        ];
    }
}
