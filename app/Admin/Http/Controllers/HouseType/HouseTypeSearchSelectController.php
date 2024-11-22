<?php
namespace App\Admin\Http\Controllers\HouseType;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\HouseType\HouseTypeSearchSelectResource;
use App\Admin\Repositories\HouseType\HouseTypeRepositoryInterface;

class HouseTypeSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        HouseTypeRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => HouseTypeSearchSelectResource::collection($this->instance)
        ];
    }
}
