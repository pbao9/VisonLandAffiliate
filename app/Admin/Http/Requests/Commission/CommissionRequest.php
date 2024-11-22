<?php

namespace App\Admin\Http\Requests\Commission;

use App\Admin\Http\Requests\BaseRequest;

class CommissionRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'direct_commission' => ['required', 'integer'],
            'indirect_commission' => ['required', 'integer'],
            // 'indirect_commission_f1' => ['required', 'integer'],
            // 'indirect_commission_f2' => ['required', 'integer'],
            // 'indirect_commission_f3' => ['required', 'integer'],

        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Commission,id'],
            'direct_commission' => ['required', 'integer'],
            'indirect_commission' => ['required', 'integer'],
            // 'indirect_commission_f1' => ['required', 'integer'],
            // 'indirect_commission_f2' => ['required', 'integer'],
            // 'indirect_commission_f3' => ['required', 'integer'],

        ];
    }
}
