<?php

namespace App\Admin\Providers;

use App\Admin\View\Composers\Notification\NotificationComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            'admin.layouts.partials.notification'
        ], NotificationComposer::class);
    }
}
