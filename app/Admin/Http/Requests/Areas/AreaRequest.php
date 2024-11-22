<?php

namespace App\Admin\Http\Requests\Areas;

use App\Admin\Http\Requests\BaseRequest;


class AreaRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'name' => ['required', 'string', 'max:50'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Areas,id'],
            'name' => ['required', 'string'],
        ];
    }
}
