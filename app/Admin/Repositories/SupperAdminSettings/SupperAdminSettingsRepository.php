<?php

namespace App\Admin\Repositories\SupperAdminSettings;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\SupperAdminSettings\SupperAdminSettingsRepositoryInterface;
use App\Models\SupperAdminSettings;

class SupperAdminSettingsRepository extends EloquentRepository implements SupperAdminSettingsRepositoryInterface
{

    protected $select = [];

    public function getModel(){
        return SupperAdminSettings::class;
    }


    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC'){
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
}