<?php

namespace App\Admin\Http\Requests\Articles;

use App\Admin\Http\Requests\BaseRequest;

class ArticlesRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'admin_id' => ['nullable', 'integer'],
            'code' => ['nullable', 'string'],
            'type' => ['required', 'integer'],
            'title' => ['required', 'string'],
            'slug' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'area' => ['required', 'string'],
            'price_level' => ['required', 'string'],
            'price_consent' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'height_floor' => ['nullable', 'integer'],
            'project_size' => ['required', 'integer'],
            'investor' => ['nullable', 'string'],
            'constructor' => ['nullable', 'string'],
            'hand_over' => ['nullable', 'string'],
            'deployment_time' => ['nullable', 'string'],
            'operative_management' => ['nullable', 'string'],
            'building_density' => ['nullable', 'integer'],
            'utilities' => ['nullable', 'string'],
            'image' => ['required'],
            'name_contact' => ['nullable', 'string'],
            'phone_contact' => ['required', 'string'],
            'status' => ['nullable', 'integer'],
            'active_days' => ['nullable', 'integer'],
            'time_start' => ['nullable', 'string'],
            'district_id' => ['required', 'integer'],
            'ward_id' => ['required', 'integer'],
            'province_id' => ['required', 'integer'],
            'commission_id' => ['required', 'integer'],
            'area_id' => ['nullable', 'integer'],
            'houseType_id' => ['nullable', 'array'],
            'houseType_id.*' => ['integer'],
            'broker_id' => ['nullable', 'array'],
            'broker_id.*' => ['integer'],
            'active_status' => ['nullable', 'integer'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Articles,id'],
            'user_id' => ['nullable', 'integer'],
            'admin_id' => ['nullable', 'integer'],
            'code' => ['nullable', 'string'],
            'type' => ['required', 'integer'],
            'title' => ['required', 'string'],
            'slug' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'area' => ['required', 'string'],
            'price_level' => ['required', 'string'],
            'price_consent' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'height_floor' => ['nullable', 'integer'],
            'project_size' => ['required', 'integer'],
            'investor' => ['nullable', 'string'],
            'constructor' => ['nullable', 'string'],
            'hand_over' => ['nullable', 'string'],
            'operative_management' => ['nullable', 'string'],
            'deployment_time' => ['nullable', 'string'],
            'building_density' => ['nullable', 'integer'],
            'utilities' => ['nullable', 'string'],
            'image' => ['required'],
            'name_contact' => ['nullable', 'string'],
            'phone_contact' => ['required', 'string'],
            'status' => ['required', 'integer'],
            'active_days' => ['nullable', 'integer'],
            'time_start' => ['nullable', 'string'],
            'district_id' => ['required', 'integer'],
            'ward_id' => ['required', 'integer'],
            'province_id' => ['required', 'integer'],
            'commission_id' => ['nullable', 'integer'],
            'area_id' => ['required', 'integer'],
            'houseType_id' => ['nullable', 'array'],
            'houseType_id.*' => ['integer'],
            'active_status' => ['required', 'integer'],
        ];
    }
}
