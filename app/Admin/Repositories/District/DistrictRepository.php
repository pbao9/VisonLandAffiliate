<?php

namespace App\Admin\Repositories\District;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\District\DistrictRepositoryInterface;
use App\Models\District;
use App\Models\Province;

class DistrictRepository extends EloquentRepository implements DistrictRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return District::class;
    }

    public function getDistrict()
    {
        return District::all();
    }
    public function searchAllLimit($keySearch = '', $provinceId = 0)
    {
        $province = Province::find($provinceId);
        if (!$province) {
            return collect([]);
        }

        return $this->model->where('province_id', $province->id)
            ->where('name', 'like', "%{$keySearch}%")
            ->get();
    }
}
