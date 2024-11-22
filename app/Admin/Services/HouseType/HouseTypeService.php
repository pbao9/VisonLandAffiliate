<?php

namespace App\Admin\Services\HouseType;

use App\Admin\Services\HouseType\HouseTypeServiceInterface;
use App\Admin\Repositories\HouseType\HouseTypeRepositoryInterface;
use Illuminate\Http\Request;

class HouseTypeService implements HouseTypeServiceInterface
{
    /**
     * Current Object instance
     *F
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(HouseTypeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        return $this->repository->create($this->data);
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();
        return $this->repository->update($this->data['id'], $this->data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
