<?php

namespace App\Api\V1\Repositories\Area;
use App\Admin\Repositories\Areas\AreasRepository as AdminAreaRepository;
use App\Api\V1\Repositories\Area\AreaRepositoryInterface;
use App\Models\Areas;

class AreaRepository extends AdminAreaRepository implements AreaRepositoryInterface
{
    public function getModel(){
        return Areas::class;
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