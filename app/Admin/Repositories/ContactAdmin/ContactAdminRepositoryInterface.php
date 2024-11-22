<?php

namespace App\Admin\Repositories\ContactAdmin;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface ContactAdminRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}