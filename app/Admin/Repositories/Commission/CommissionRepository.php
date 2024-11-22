<?php

namespace App\Admin\Repositories\Commission;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Commission\CommissionRepositoryInterface;
use App\Models\Commission;

class CommissionRepository extends EloquentRepository implements CommissionRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Commission::class;
    }

    public function getCommission()
    {
        return Commission::all();
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}
