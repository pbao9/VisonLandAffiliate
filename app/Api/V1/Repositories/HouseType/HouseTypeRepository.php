<?php

namespace App\Api\V1\Repositories\HouseType;
use App\Admin\Repositories\HouseType\HouseTypeRepository as AdminHouseTypeRepository;
use App\Api\V1\Repositories\HouseType\HouseTypeRepositoryInterface;
use App\Models\HouseType;

class HouseTypeRepository extends AdminHouseTypeRepository implements HouseTypeRepositoryInterface
{
    public function getModel(){
        return HouseType::class;
    }
	
    public function findByID($id)
    {
        $this->instance = $this->model->where('id', $id)
        ->firstOrFail();
		
        if ($this->instance && $this->instance->exists()) {
			return $this->instance;
		}

		return null;
    }
    public function paginate($page = 1, $limit = 10)
    {
        $page = $page ? $page - 1 : 0;
        $this->instance = $this->model
        ->offset($page * $limit)
        ->limit($limit)
        ->orderBy('id', 'desc')
        ->get();
        return $this->instance;
    }
}