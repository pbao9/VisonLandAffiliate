<?php

namespace App\Admin\Repositories\CustomerRegistrations;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\CustomerRegistrations\CustomerRegistrationsRepositoryInterface;
use App\Models\CustomerRegistrations;

class CustomerRegistrationsRepository extends EloquentRepository implements CustomerRegistrationsRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return CustomerRegistrations::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
    public function getQueryBuilderByColumns($column, $value)
    {
        $this->getQueryBuilderOrderBy('id', 'asc');
        $this->instance = $this->instance->where($column, $value);
        return $this->instance;
    }
}
