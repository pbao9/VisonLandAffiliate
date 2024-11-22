<?php

namespace App\Admin\Repositories\Broker;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Broker\BrokerRepositoryInterface;
use App\Models\User;

class BrokerRepository extends EloquentRepository implements BrokerRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return User::class;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'fullname', 'phone'], $limit = 10)
    {
        $this->instance = $this->model->select($select);
        $this->getQueryBuilderFindByKey($keySearch);
        $this->instance = $this->instance->where('roles', 2);

        foreach ($meta as $key => $value) {
            $this->instance = $this->instance->where($key, $value); 
        }

        return $this->instance->limit($limit)->get();
    }


    protected function getQueryBuilderFindByKey($key)
    {
        $this->instance = $this->instance->where(function ($query) use ($key) {
            return $query->where('fullname', 'LIKE', '%' . $key . '%')
                ->orWhere('email', 'LIKE', '%' . $key . '%')
                ->orWhere('phone', 'LIKE', '%' . $key . '%');
        });
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}
