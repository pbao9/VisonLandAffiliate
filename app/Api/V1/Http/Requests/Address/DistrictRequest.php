<?php

namespace App\Api\V1\Http\Requests\Address;

use App\Api\V1\Http\Requests\BaseRequest;

class DistrictRequest extends BaseRequest
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
}
