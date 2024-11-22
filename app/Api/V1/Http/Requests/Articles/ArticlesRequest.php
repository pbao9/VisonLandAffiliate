<?php

namespace App\Api\V1\Http\Requests\Articles;

use App\Api\V1\Http\Requests\BaseRequest;

class ArticlesRequest extends BaseRequest
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
            'id' => ['nullable'],
            'user_id' => ['nullable', 'integer'],
            'code' => ['nullable', 'string'],
            'type' => ['nullable', 'integer'],
            'title' => ['nullable', 'string'],
            'slug' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'area' => ['nullable', 'string'],
            'price_level' => ['nullable', 'string'],
            'price_consent' => ['nullable', 'integer'],
            'active_status' => ['nullable', 'integer'],
            'quantity' => ['nullable', 'integer'],
            'height_floor' => ['nullable', 'integer'],
            'project_size' => ['nullable', 'integer'],
            'investor' => ['nullable', 'string'],
            'constructor' => ['nullable', 'string'],
            'hand_over' => ['nullable', 'string'],
            'deployment_time' => ['nullable', 'string'],
            'building_density' => ['nullable', 'integer'],
            'utilities' => ['nullable', 'string'],
            'image' => ['nullable'],
            'name_contact' => ['nullable', 'string'],
            'commission_id' => ['nullable', 'integer'],
            'phone_contact' => ['nullable', 'string'],
            'status' => ['nullable', 'integer'],
            'active_days' => ['required', 'integer'],
            'time_start' => ['nullable', 'string'],
            'district_id' => ['nullable', 'integer'],
            'ward_id' => ['nullable', 'integer'],
            'province_id' => ['nullable', 'integer'],
            'area_id' => ['nullable', 'integer'],
            'houseType_id' => ['nullable'],
            'operative_management' => ['nullable', 'string'],
            'broker_id' => ['nullable', 'array'],
            'broker_id.*' => ['integer'],
            'article_status' => ['nullable', 'integer'],
            'type_post' => ['nullable', 'integer'],
            'price_post_type' => ['nullable']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required'],
            'user_id' => ['nullable', 'integer'],
            'code' => ['nullable', 'string'],
            'type' => ['nullable', 'integer'],
            'title' => ['nullable', 'string'],
            'slug' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'area' => ['nullable', 'string'],
            'price_level' => ['nullable', 'string'],
            'price_consent' => ['nullable', 'integer'],
            'active_status' => ['nullable', 'integer'],
            'quantity' => ['nullable', 'integer'],
            'height_floor' => ['nullable', 'integer'],
            'project_size' => ['nullable', 'integer'],
            'investor' => ['nullable', 'string'],
            'constructor' => ['nullable', 'string'],
            'hand_over' => ['nullable', 'string'],
            'deployment_time' => ['nullable', 'string'],
            'building_density' => ['nullable', 'integer'],
            'utilities' => ['nullable', 'string'],
            'image' => ['nullable', 'array'],
            'name_contact' => ['nullable', 'string'],
            'commission_id' => ['nullable', 'integer'],
            'phone_contact' => ['nullable', 'string'],
            'status' => ['nullable', 'integer'],
            'active_days' => ['nullable', 'integer'],
            'time_start' => ['nullable', 'string'],
            'district_id' => ['nullable', 'integer'],
            'ward_id' => ['nullable', 'integer'],
            'province_id' => ['nullable', 'integer'],
            'area_id' => ['nullable', 'integer'],
            'houseType_id' => ['nullable'],
            'operative_management' => ['nullable', 'string'],
            'broker_id' => ['nullable', 'array'],
            'broker_id.*' => ['integer'],
            'article_status' => ['nullable', 'integer'],
        ];
    }
}
