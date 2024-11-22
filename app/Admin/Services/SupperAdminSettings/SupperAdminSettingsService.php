<?php

namespace App\Admin\Services\SupperAdminSettings;

use App\Admin\Services\SupperAdminSettings\SupperAdminSettingsServiceInterface;
use  App\Admin\Repositories\SupperAdminSettings\SupperAdminSettingsRepositoryInterface;
use Illuminate\Http\Request;

class SupperAdminSettingsService implements SupperAdminSettingsServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(SupperAdminSettingsRepositoryInterface $repository){
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