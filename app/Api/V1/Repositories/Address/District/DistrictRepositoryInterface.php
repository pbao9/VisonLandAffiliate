<?php

namespace App\Api\V1\Repositories\Address\District;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface DistrictRepositoryInterface extends EloquentRepositoryInterface
{
    public function getAll();
    public function getProvinceDistrict();
    public function paginate($page = 1, $limit = 10);
}
