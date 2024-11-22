<?php

namespace App\Admin\Repositories\CommissionDetail;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface CommissionDetailRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');

    public function getModel();

    public function where($field, $value);
    public function getComissionDetail($id);
}