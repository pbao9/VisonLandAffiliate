<?php

namespace App\Api\V1\Repositories\Notification;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface NotificationRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id, $user);
    public function getByUserId($user, $status = null);
    public function paginate($page = 1, $limit = 10, $user);
    public function delete($id);
}
