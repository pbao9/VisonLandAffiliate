<?php

namespace App\Api\V1\Repositories\HouseType;
use App\Admin\Repositories\EloquentRepositoryInterface;
    

interface HouseTypeRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
}