<?php

namespace App\Admin\Repositories\Notification;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Notification\NotificationRepositoryInterface;
use App\Enums\Notification\NotificationEnum;
use App\Models\Notification;

class NotificationRepository extends EloquentRepository implements NotificationRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Notification::class;
    }

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function getByAdminID($adminId, $limit = null, $status = null)
    {
        $query = $this->model->where('admin_id', $adminId);

        if ($status !== null) {
            $query->where('status', $status);
        }

        if ($limit !== null) {
            return $query->paginate($limit);
        }

        return $query->get();
    }

    public function getByAdmin($adminId, $status = null)
    {
        $query = $this->model->where('admin_id', $adminId);

        if ($status !== null) {
            $query->where('status', $status);
        }

        return $query;
    }
}
