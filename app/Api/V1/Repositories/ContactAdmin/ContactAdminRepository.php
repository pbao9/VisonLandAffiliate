<?php

namespace App\Api\V1\Repositories\ContactAdmin;
use App\Admin\Repositories\ContactAdmin\ContactAdminRepository as AdminContactAdminRepository;
use App\Api\V1\Repositories\ContactAdmin\ContactAdminRepositoryInterface;
use App\Models\ContactAdmin;

class ContactAdminRepository extends AdminContactAdminRepository implements ContactAdminRepositoryInterface
{
    public function getModel(){
        return ContactAdmin::class;
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
            ContactAdmin::findOrFail($id)->delete();
            return 1;
        } catch (\Exception $e) {
            return 0;
        } 
    }
}