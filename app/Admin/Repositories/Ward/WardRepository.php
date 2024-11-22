<?php

namespace App\Admin\Repositories\Ward;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Ward\WardRepositoryInterface;
use App\Models\District;
use App\Models\Wards;

class WardRepository extends EloquentRepository implements WardRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Wards::class;
    }

    public function getWard()
    {
        return Wards::all();
    }

    public function searchAllLimit($keySearch = '', $districtId = 0)
    {
        $district = District::find($districtId);
        if (!$district) {
            return collect([]);
        }

        return $this->model->where('district_id', $district->id)
            ->where('name', 'like', "%{$keySearch}%")
            ->get();
    }
}
