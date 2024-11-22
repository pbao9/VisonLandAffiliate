<?php

namespace App\Admin\Repositories\District;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface DistrictRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * make query
     * 
     * @return mixed
     */
    public function getDistrict();
}