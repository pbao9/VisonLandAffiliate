<?php

namespace App\Api\V1\Repositories\Area;
use App\Admin\Repositories\EloquentRepositoryInterface;
    

interface AreaRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
}