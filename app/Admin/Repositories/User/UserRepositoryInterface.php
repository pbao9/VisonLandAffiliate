<?php

namespace App\Admin\Repositories\User;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchAllLimit($value = '', $meta = [], $select = [], $limit = 10);
    public function findOrFailWithRelations($id, $relations = ['customers']);
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function getUserRoleById($userId);
    public function getUserFirst();
    public function GetUserByParentId($userId);
}
