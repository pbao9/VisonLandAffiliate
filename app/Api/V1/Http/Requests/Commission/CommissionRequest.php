<?php

namespace App\Api\V1\Http\Requests\Commission;

use App\Api\V1\Http\Requests\BaseRequest;

class CommissionRequest extends BaseRequest
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
            'indirect_commission_default' => ['required', 'integer'],
            'direct_commission_default' => ['required', 'integer'],             
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Commission,id'],
            'indirect_commission_default' => ['required', 'int'],
            'direct_commission_default' => ['required', 'int'],
        ];
    }
}