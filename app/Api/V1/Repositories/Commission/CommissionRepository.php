<?php

namespace App\Api\V1\Repositories\Commission;
use App\Admin\Repositories\Commission\CommissionRepository as AdminCommissionRepository;
use App\Api\V1\Repositories\Commission\CommissionRepositoryInterface;
use App\Models\Commission;

class CommissionRepository extends AdminCommissionRepository implements CommissionRepositoryInterface
{
    public function getModel(){
        return Commission::class;
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
	public function delete($id)
    {
        try {
            Commission::findOrFail($id)->delete();
            return 1;
        } catch (\Exception $e) {
            return 0;
        } 
    }
}