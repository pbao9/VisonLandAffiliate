<?php

namespace App\Admin\Repositories\Collaboration;

use App\Admin\Repositories\EloquentRepository;
use App\Models\Collaboration;

class CollaborationRepository extends EloquentRepository implements CollaborationRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Collaboration::class;
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
