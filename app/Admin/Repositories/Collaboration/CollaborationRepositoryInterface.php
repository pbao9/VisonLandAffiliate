<?php

namespace App\Admin\Repositories\Collaboration;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface CollaborationRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');

    public function getModel();
    public function getQueryBuilderByColumns($column, $value);
}
