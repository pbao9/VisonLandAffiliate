<?php

namespace App\Http\Livewire;

use App\Admin\Repositories\Notification\NotificationRepositoryInterface;
use Livewire\Component;
use App\Models\Notification;
use Livewire\WithPagination;

class NotificationComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $notificationRepository;
    public function mount(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
        $this->notifications = $this->notificationRepository->getAll();
    }

    public function getQueryString()
    {
        return [];
    }
    public function render()
    {
        $auth = auth()->guard('admin')->user();
        return view('livewire.notification', [
            'data' => Notification::where('admin_id', $auth->id)->paginate(6, ['*']),
            'admin' => $auth,
        ]);
    }

    public function pollNotifications()
    {
    }

}
