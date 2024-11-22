<?php

namespace App\Admin\Services\Customers;

use App\Admin\Services\Customers\CustomersServiceInterface;
use  App\Admin\Repositories\Customers\CustomersRepositoryInterface;
use Illuminate\Http\Request;

class CustomersService implements CustomersServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(CustomersRepositoryInterface $repository){
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