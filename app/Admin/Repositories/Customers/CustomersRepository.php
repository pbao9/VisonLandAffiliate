<?php

namespace App\Admin\Repositories\Customers;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Customers\CustomersRepositoryInterface;
use App\Models\Customers;

class CustomersRepository extends EloquentRepository implements CustomersRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return Customers::class;
    }
    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'customer_name', 'phone'], $limit = 10){
        $this->instance = $this->model->select($select);
        $this->getQueryBuilderFindByKey($keySearch);

        foreach($meta as $key => $value){
            $this->instance = $this->instance->where($key, $value);
        }

        return $this->instance->limit($limit)->get();
    }

    protected function getQueryBuilderFindByKey($key){
        $this->instance = $this->instance->where(function($query) use ($key){
            return $query->where('customer_name', 'LIKE', '%'.$key.'%')
                ->orWhere('phone', 'LIKE', '%'.$key.'%')
                ->orWhere('refferal_code', 'LIKE', '%'.$key.'%');
        });
    }
    public function findOrFailWithRelations($id, $relations = ['user'])
    {
        $this->findOrFail($id);
        $this->instance = $this->instance->load($relations);
        return $this->instance;
    }

    public function getQueryBuilderByColumns($column, $value){
        $this->getQueryBuilderOrderBy('id', 'asc');
        $this->instance = $this->instance->where($column, $value);
        return $this->instance;
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}
