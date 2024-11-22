<?php

namespace App\Admin\Http\Requests\HouseTypes;

use App\Admin\Http\Requests\BaseRequest;

class HouseTypeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'id' => ['nullable', 'integer'],
            'name' => ['required', 'string'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'integer'],
            'name' => ['required', 'string'],
        ];
    }
}
