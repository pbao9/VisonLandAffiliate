<?php

namespace App\Api\V1\Repositories\Address\Ward;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface WardRepositoryInterface extends EloquentRepositoryInterface
{
    public function getAll();
    public function getProvinceDistrict();
    public function paginate($page = 1, $limit = 10);
}
