<?php


namespace App\Admin\View\Composers\Notification;

use App\Enums\Notification\NotificationEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationComposer
{
    protected $repository;

    public function __construct()
    {
        $this->repository = app()->make('App\Admin\Repositories\Notification\NotificationRepositoryInterface');
    }

    public function compose(View $view)
    {
        $adminID = Auth::guard('admin')->user()->id;
        $notifications = $this->repository->getByAdminID($adminID, 10, NotificationEnum::NotSeen);
        $view->with('noti', $notifications);
    }
}
