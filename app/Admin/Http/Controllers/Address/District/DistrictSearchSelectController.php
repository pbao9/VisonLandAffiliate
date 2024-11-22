<?php

namespace App\Admin\Http\Controllers\Address\District;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Area\AreaSearchSelectResource;
use App\Admin\Repositories\District\DistrictRepositoryInterface;
use App\Admin\Repositories\Province\ProvinceRepositoryInterface;

class DistrictSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        DistrictRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    protected function data()
    {
        $term = $this->request->input('term', '');
        $provinceId = $this->request->input('province_id', '');

        $this->instance = $this->repository->searchAllLimit($term, $provinceId);
    }

    protected function selectResponse()
    {
        $this->instance = [
            'results' => AreaSearchSelectResource::collection($this->instance)
        ];
    }
}
