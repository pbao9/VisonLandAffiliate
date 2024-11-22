<?php

namespace App\Admin\Repositories\Province;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Province\ProvinceRepositoryInterface;
use App\Models\Province;

class ProvinceRepository extends EloquentRepository implements ProvinceRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Province::class;
    }

    public function getProvince()
    {
        return Province::all();
    }

    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'name'], $limit = null)
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
}
