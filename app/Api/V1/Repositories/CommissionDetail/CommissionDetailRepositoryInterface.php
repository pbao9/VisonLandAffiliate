<?php

namespace App\Api\V1\Repositories\CommissionDetail;
use App\Admin\Repositories\EloquentRepositoryInterface;


interface CommissionDetailRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
    public function delete($id);
}