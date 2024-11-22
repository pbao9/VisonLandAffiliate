<?php

namespace App\Admin\Http\Controllers\Notification;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Repositories\Notification\NotificationRepository;
use App\Admin\Http\Resources\Notification\NotificationSearchSelectResource;
use App\Admin\Repositories\Notification\NotificationRepositoryInterface;

class NotificationSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        NotificationRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => NotificationSearchSelectResource::collection($this->instance)
        ];
    }
}
