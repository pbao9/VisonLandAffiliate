<?php

namespace App\Admin\Http\Controllers\Customers;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Customers\CustomersRequest;
use App\Admin\Repositories\Customers\CustomersRepositoryInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Services\Customers\CustomersServiceInterface;
use App\Admin\DataTables\Customers\CustomersDataTable;
use App\Enums\Customer\CustomerStatus;


class CustomersController extends Controller
{
    public function __construct(
        CustomersRepositoryInterface $repository,
        UserRepositoryInterface $userRepository,
        CustomersServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->service = $service;
    }

    public function getView()
    {
        return [
            'index' => 'admin.customers.index',
            'create' => 'admin.customers.create',
            'edit' => 'admin.customers.edit',

        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.user.customer.index',
            'create' => 'admin.user.customer.create',
            'edit' => 'admin.user.customer.edit',
            'delete' => 'admin.user.customer.delete'
        ];
    }
    public function index($user_id, CustomersDataTable $dataTable)
    {
        $user = $this->userRepository->findOrFail($user_id);
        return $dataTable->with('user', $user)->render($this->view['index'], [
            'user' => $user,
            'status' => CustomerStatus::asSelectArray()
        ]);
    }

    public function create($user_id)
    {

        $user = $this->userRepository->findOrFail($user_id);
        return view($this->view['create'], [
            'user' => $user,
            'status' => CustomerStatus::asSelectArray()
        ]);
    }

    public function store(CustomersRequest $request)
    {

        $response = $this->service->store($request);
        if ($response) {
            return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id)
    {
        $customer = $this->repository->findOrFailWithRelations($id);
        return view($this->view['edit'], [
            'customer' => $customer,
            'status' => CustomerStatus::asSelectArray()
        ]);
    }


    public function update(CustomersRequest $request)
    {

        $response = $this->service->update($request);
        if ($response) {
            return to_route($this->route['index'], $response->user_id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function delete($user_id, $id)
    {

        $this->service->delete($id);

        return to_route($this->route['index'], $user_id)->with('success', __('notifySuccess'));
    }
}
