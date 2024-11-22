<?php

namespace App\Admin\Services\Collaboration;

use Illuminate\Http\Request;
use App\Admin\Repositories\Articles\ArticlesRepositoryInterface;
use App\Admin\Repositories\Collaboration\CollaborationRepositoryInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;

class CollaborationService implements CollaborationServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    protected $articlesRepository;
    protected $userRepository;

    public function __construct(
        CollaborationRepositoryInterface $repository,
        ArticlesRepositoryInterface $articlesRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->articlesRepository = $articlesRepository;
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function store(Request $request)
    {

        $this->data = $request->validated();
        return $this->repository->create($this->data);
    }

    public function update(Request $request)
    {

        $this->data = $request->validated();
        return $this->repository->updated($this->data['id'], $this->data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
