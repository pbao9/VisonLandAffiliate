<?php

namespace App\Observers;

use App\Enums\Notification\NotificationEnum;
use App\Models\Articles;
use App\Models\Notification;
use App\Models\User;

class ArticleObserver
{
    /**
     * Handle the Articles "created" event.
     *
     * @param  \App\Models\Articles  $articles
     * @return void
     */
    public function created(Articles $articles)
    {
        $users = User::all();

        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'article_id' => $articles->id,
                'title' => 'Dự án mới từ hệ thống',
                'content' => $articles->title,
                'status' => NotificationEnum::NotSeen,
            ]);
        }
    }

    /**
     * Handle the Articles "updated" event.
     *
     * @param  \App\Models\Articles  $articles
     * @return void
     */
    public function updated(Articles $articles)
    {
        //
    }

    /**
     * Handle the Articles "deleted" event.
     *
     * @param  \App\Models\Articles  $articles
     * @return void
     */
    public function deleted(Articles $articles)
    {
        //
    }

    /**
     * Handle the Articles "restored" event.
     *
     * @param  \App\Models\Articles  $articles
     * @return void
     */
    public function restored(Articles $articles)
    {
        //
    }

    /**
     * Handle the Articles "force deleted" event.
     *
     * @param  \App\Models\Articles  $articles
     * @return void
     */
    public function forceDeleted(Articles $articles)
    {
        //
    }
}
