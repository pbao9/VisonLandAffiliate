<?php

namespace App\Admin\Repositories\CustomerRegistrations;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface CustomerRegistrationsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');

    public function getModel();
    public function getQueryBuilderByColumns($column, $value);
}