<?php

namespace App\Api\V1\Repositories\Notification;

use App\Admin\Repositories\Notification\NotificationRepository as AdminNotificationRepository;
use App\Api\V1\Repositories\Notification\NotificationRepositoryInterface;
use App\Models\Notification;

class NotificationRepository extends AdminNotificationRepository implements NotificationRepositoryInterface
{
    public function getModel()
    {
        return Notification::class;
    }

    public function findByID($id, $user)
    {
        $this->instance = $this->model
            ->where('id', $id)
            ->where('user_id', $user)
            ->first();

        if ($this->instance) {
            return $this->instance;
        }

        return [
            'status' => 404,
            'message' => __('Không tồn tại')
        ];
    }

    public function getByUserId($user, $status = null)
    {
        $query = $this->model->where('user_id', $user);

        if ($status !== null) {
            $query->where('status', $status);
        }

        return $query->get();
    }
    public function paginate($page = 1, $limit = 10, $user)
    {
        $query = $this->model->where('user_id', $user);

        $page = is_numeric($page) && $page > 0 ? (int) $page - 1 : 0;
        $limit = is_numeric($limit) && $limit > 0 ? (int) $limit : 10;
        $total = $query->count();
        $totalPages = (int) ceil($total / $limit);

        $results = $query
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->offset($page * $limit)
            ->get();

        if ($results->isEmpty()) {
            throw new \Exception('Dữ liệu không tồn tại!');
        }

        return [
            'data' => $results,
            'total' => $total,
            'totalPages' => $totalPages,
            'currentPage' => $page + 1,
            'hasPrev' => $page > 0,
            'hasNext' => $page < $totalPages - 1,
        ];
    }

    public function delete($id)
    {
        try {
            Notification::findOrFail($id)->delete();
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }
}
