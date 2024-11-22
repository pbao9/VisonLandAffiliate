<?php

namespace App\Admin\Http\Controllers\Notification;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Notification\NotificationRequest;
use App\Admin\Repositories\Notification\NotificationRepositoryInterface;
use App\Admin\Services\Notification\NotificationServiceInterface;
use App\Admin\DataTables\Notification\NotificationDataTable;
use App\Enums\Notification\NotificationEnum;
use App\Models\Notification;
use App\Admin\Repositories\Admin\AdminRepositoryInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Models\User;


class NotificationController extends Controller
{

    protected $repositoryAdmin;
    protected $repositoryUser;

    public function __construct(
        NotificationRepositoryInterface $repository,
        NotificationServiceInterface $service,
        AdminRepositoryInterface $repositoryAdmin,
        UserRepositoryInterface $repositoryUser
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->repositoryAdmin = $repositoryAdmin;
        $this->repositoryUser = $repositoryUser;

        $this->service = $service;
    }

    public function getView()
    {
        return [
            'index' => 'admin.notification.index',
            'create' => 'admin.notification.create',
            'edit' => 'admin.notification.edit',
            'showAll' => 'admin.notification.show-all',
            'detail' => 'admin.notification.detail'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.notification.index',
            'create' => 'admin.notification.create',
            'edit' => 'admin.notification.edit',
            'delete' => 'admin.notification.delete'
        ];
    }
    public function index(NotificationDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'status' => NotificationEnum::asSelectArray(),
        ]);
    }

    public function showAll()
    {
        $admin = auth()->user()->id;
        $notification = $this->repository->getByAdminID($admin, 10, null);
        return view($this->view['showAll'], [
            'noti' => $notification,
            'status' => NotificationEnum::Seen,
        ]);
    }
    // public function read(NotificationRequest $request)
    // {
    //     $this->service->read($request);

    //     return back()->with('success', __('Đã đọc thông báo'));
    // }

    public function readAll()
    {
        $adminId = auth()->user()->id;

        $this->repository->getByAdmin($adminId)
            ->where('status', '!=', NotificationEnum::Seen)
            ->update(['status' => NotificationEnum::Seen]);

        return back()->with('success', __('Đã đọc toàn bộ thông báo'));
    }


    public function create()
    {
        $usernames = User::pluck('username', 'id');
        return view($this->view['create'], [
            'status' => NotificationEnum::asSelectArray(),
            'usernames' => $usernames,
        ]);
    }

    public function store(NotificationRequest $request)
    {
        $response = $this->service->store($request);
        if ($response) {
            return to_route($this->route['index'])->with('success', __('Thêm thành công'))->withInput();
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id)
    {
        $getAdmin = $this->repositoryAdmin->getCurrentAdminID();
        $fullnames = User::pluck('fullname', 'id');
        // $user = $this->repositoryUser->find($user_id);
        $response = $this->repository->findOrFail($id);
        $field = User::all();
        return view($this->view['edit'], [
            'getAdmin' => $getAdmin,
            'field' => $field,
            'status' => NotificationEnum::asSelectArray(),
            'notification' => $response,
            'fullname' => $fullnames
        ]);
    }

    public function detail($id)
    {
        $notification = $this->repository->find($id);

        if ($notification) {
            $notification->update(['status' => NotificationEnum::Seen]);
        }
        return view($this->view['detail'], [
            'noti' => $notification,
        ]);
    }


    public function update(NotificationRequest $request)
    {

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));
    }

    public function delete($id)
    {

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));
    }
}
