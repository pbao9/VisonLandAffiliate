<?php

namespace App\Api\V1\Http\Requests\Articles;

use App\Api\V1\Http\Requests\BaseRequest;

class ArticlePaymentRequest extends BaseRequest
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
            'article_id' => ['nullable', 'integer'],
            'document' => ['nullable'],
        ];
    }
}
