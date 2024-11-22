<?php

namespace App\Admin\Services\Area;

use App\Admin\Services\Area\AreaServiceInterface;
use App\Admin\Repositories\Areas\AreasRepositoryInterface;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;

class AreaService implements AreaServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(AreasRepositoryInterface $repository)
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
