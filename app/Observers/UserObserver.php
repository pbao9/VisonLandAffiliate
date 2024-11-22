<?php

namespace App\Observers;

use App\Admin\Services\File\FileService;
use App\Enums\Notification\NotificationEnum;
use App\Models\Admin;
use App\Models\Notification;
use App\Models\User;

class UserObserver
{

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct() {}
    public function created(User $user)
    {
        $admins = Admin::all();

        foreach ($admins as $admin) {
            Notification::create([
                'title' => 'Có thành viên đăng ký mới!',
                'admin_id' => $admin->id,
                'status' => NotificationEnum::NotSeen,
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
