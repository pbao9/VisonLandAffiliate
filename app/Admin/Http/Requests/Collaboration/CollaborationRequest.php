<?php

namespace App\Admin\Http\Requests\Collaboration;

use App\Admin\Http\Requests\BaseRequest;

class CollaborationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'customer_id' => ['required', 'int'],
            'article_id' => ['required', 'int'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Collaboration,id'],
            'user_id' => ['nullable', 'int'],
            'article_id' => ['required', 'int'],
        ];
    }
}
