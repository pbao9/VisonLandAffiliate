<?php

namespace App\Admin\Http\Controllers\Address\Ward;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Area\AreaSearchSelectResource;
use App\Admin\Repositories\District\DistrictRepositoryInterface;
use App\Admin\Repositories\Ward\WardRepositoryInterface;

class WardSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        WardRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    protected function data()
    {
        $term = $this->request->input('term', '');
        $districtId = $this->request->input('district_id', '');

        $this->instance = $this->repository->searchAllLimit($term, $districtId);
    }


    protected function selectResponse()
    {
        $this->instance = [
            'results' => AreaSearchSelectResource::collection($this->instance)
        ];
    }
}
