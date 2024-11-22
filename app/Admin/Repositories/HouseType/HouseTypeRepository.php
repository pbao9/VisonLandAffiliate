<?php

namespace App\Admin\Repositories\HouseType;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\HouseType\HouseTypeRepositoryInterface;
use App\Models\HouseType;

class HouseTypeRepository extends EloquentRepository implements HouseTypeRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return HouseType::class;
    }

    public function getHouseType()
    {
        return HouseType::all();
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

    public function getQueryBuilderByColumns($column, $value)
    {
        $this->getQueryBuilderOrderBy('id', 'asc');
        $this->instance = $this->instance->where($column, $value);
        return $this->instance;
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    // public function getHouseTypesByIds($houseTypeIds)
    // {
    //     return HouseType::whereIn('id', $houseTypeIds)->get();
    // }
}
