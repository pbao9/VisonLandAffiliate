<?php

namespace App\Admin\Http\Controllers\Address\Province;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Area\AreaSearchSelectResource;
use App\Admin\Repositories\Areas\AreasRepositoryInterface;
use App\Admin\Repositories\Province\ProvinceRepositoryInterface;

class ProvinceSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        ProvinceRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    protected function selectResponse()
    {
        $this->instance = [
            'results' => AreaSearchSelectResource::collection($this->instance)
        ];
    }
}
