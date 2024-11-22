<?php
namespace App\Api\V1\Http\Requests\Auth;
use App\Api\V1\Http\Requests\BaseRequest;
class UpdateCCcdRequest extends BaseRequest{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(){
        return[
            'cccd_number'=>['required','string','regex:/^[0-9]{12}$/'],
            'cccd_front_image'=>['required',],
            'cccd_back_image'=>['required'],
            'issued_by'=>['required','string'],
            'issued_day'=>['required']
        ];
    }
}
?>