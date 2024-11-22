<?php

namespace App\Admin\Repositories\Notification;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface NotificationRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function getByAdminID($adminId, $limit = null, $status = null);
    public function getByAdmin($adminId, $status = null);
}
