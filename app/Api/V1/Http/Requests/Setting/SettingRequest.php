<?php

namespace App\Api\V1\Http\Requests\Setting;

use App\Api\V1\Http\Requests\BaseRequest;

class SettingRequest extends BaseRequest
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
                    'setting_key' => ['required', 'string'],
                    'setting_name' => ['required', 'string'],
                    'plain_value' => ['required', 'string'],
                    'type_input' => ['required', 'integer'],
                    'type_data' => ['nullable', 'integer'],
                    'group' => ['required', 'integer']

        ];
    }
}
