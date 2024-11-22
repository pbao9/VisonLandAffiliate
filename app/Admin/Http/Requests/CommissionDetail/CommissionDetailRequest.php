<?php

namespace App\Admin\Http\Requests\CommissionDetail;

use App\Admin\Http\Requests\BaseRequest;

class CommissionDetailRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'total_amount' => ['nullable', 'integer'],
            'amount_paid' => ['nullable', 'integer'],
            'amount_percent' => ['nullable', 'numeric', 'between:0,100'],
            'status' => ['nullable', 'integer']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\CommissionDetail,id'],
            // 'commission_id' => ['required', 'int'],
            'total_amount' => ['nullable'],
            'paid_amount' => ['nullable'],
            'status' => ['nullable']
        ];
    }
}
