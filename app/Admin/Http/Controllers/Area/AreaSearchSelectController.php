<?php

namespace App\Admin\Http\Controllers\Area;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Area\AreaSearchSelectResource;
use App\Admin\Repositories\Areas\AreasRepositoryInterface;

class AreaSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        AreasRepositoryInterface $repository
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
