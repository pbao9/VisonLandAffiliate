<?php

namespace App\Admin\Repositories\Commission;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface CommissionRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');

    public function getCommission();

    public function getModel();
}