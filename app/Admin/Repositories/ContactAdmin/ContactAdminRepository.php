<?php

namespace App\Admin\Repositories\ContactAdmin;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\ContactAdmin\ContactAdminRepositoryInterface;
use App\Models\ContactAdmin;

class ContactAdminRepository extends EloquentRepository implements ContactAdminRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return ContactAdmin::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}