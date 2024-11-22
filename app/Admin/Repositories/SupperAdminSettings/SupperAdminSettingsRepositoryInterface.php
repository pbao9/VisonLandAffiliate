<?php

namespace App\Admin\Repositories\SupperAdminSettings;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface SupperAdminSettingsRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}