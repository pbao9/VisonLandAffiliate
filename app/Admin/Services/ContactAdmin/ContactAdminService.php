<?php

namespace App\Admin\Services\ContactAdmin;

use App\Admin\Services\ContactAdmin\ContactAdminServiceInterface;
use  App\Admin\Repositories\ContactAdmin\ContactAdminRepositoryInterface;
use Illuminate\Http\Request;

class ContactAdminService implements ContactAdminServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(ContactAdminRepositoryInterface $repository){
        $this->repository = $repository;
    }
    
    public function store(Request $request){

        $this->data = $request->validated();
        return $this->repository->create($this->data);
    }

    public function update(Request $request){
        
        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id){
        return $this->repository->delete($id);

    }

}