<?php

namespace App\Admin\Repositories\Customers;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface CustomersRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchAllLimit($value = '', $meta = [], $select = [], $limit = 10);
    public function findOrFailWithRelations($id, $relations = ['user']);
    public function getQueryBuilderByColumns($column, $value);
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}
