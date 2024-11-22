<?php

namespace App\Api\V1\Repositories\ContactAdmin;
use App\Admin\Repositories\EloquentRepositoryInterface;


interface ContactAdminRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
    public function delete($id);
}