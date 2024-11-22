<?php

namespace App\Api\V1\Http\Requests\CommissionDetail;

use App\Api\V1\Http\Requests\BaseRequest;

class CommissionDetailRequest extends BaseRequest
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
            'id' => ['required', 'exists:App\Models\CommissionDetail,id'],
            'total_amount' => ['required', 'integer'],
            'amount_paid' => ['required', 'integer'],
            'amount_percent' => ['nullable', 'numeric', 'between:0,100'],
            'status' => ['required', 'integer']          
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\CommissionDetail,id'],
            'total_amount' => ['required', 'integer'],
            'amount_paid' => ['required', 'integer'],
            'amount_percent' => ['nullable', 'numeric', 'between:0,100'],
            'status' => ['required', 'integer']
        ];
    }
}