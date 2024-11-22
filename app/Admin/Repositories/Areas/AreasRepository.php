<?php

namespace App\Admin\Repositories\Areas;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Areas\AreasRepositoryInterface;
use App\Models\Areas;

class AreasRepository extends EloquentRepository implements AreasRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Areas::class;
    }


    public function getArea()
    {
        return Areas::all();
    }

    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'name'], $limit = 10)
    {
        $this->instance = $this->model->select($select);
        $this->getQueryBuilderFindByKey($keySearch);

        foreach ($meta as $key => $value) {
            $this->instance = $this->instance->where($key, $value);
        }

        return $this->instance->limit($limit)->get();
    }

    protected function getQueryBuilderFindByKey($key)
    {
        $this->instance = $this->instance->where(function ($query) use ($key) {
            return $query->where('name', 'LIKE', '%' . $key . '%');
        });
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}
