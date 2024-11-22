<?php

namespace App\Admin\Http\Controllers\Collaboration;

use App\Admin\DataTables\Collaboration\CollaborationDataTable;
use App\Admin\DataTables\CustomerRegistrations\CustomerRegistrationByArticlesDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\CustomerRegistrations\CustomerRegistrationsRequest;
use App\Admin\Repositories\Articles\ArticlesRepositoryInterface;
use App\Admin\Repositories\Commission\CommissionRepositoryInterface;
use App\Admin\Repositories\CommissionDetail\CommissionDetailRepository;
use App\Admin\Repositories\CustomerRegistrations\CustomerRegistrationsRepositoryInterface;
use App\Admin\Repositories\Customers\CustomersRepositoryInterface;
use App\Admin\Services\CustomerRegistrations\CustomerRegistrationsServiceInterface;
use App\Admin\DataTables\CustomerRegistrations\CustomerRegistrationsDataTable;
use App\Admin\Repositories\Collaboration\CollaborationRepositoryInterface;
use App\Admin\Repositories\CommissionDetail\CommissionDetailRepositoryInterface;
use App\Enums\CommissionDetail\CommissionDetailType;
use App\Enums\CustomerRegistration\CustomerRegistrationStatus;
use App\Enums\CustomerRegistration\CustomerRegistrationType;


class CollaborationController extends Controller
{
    public function __construct(
        CollaborationRepositoryInterface $repository
    ) {

        parent::__construct();

        $this->repository = $repository;
    }

    public function getView()
    {
        return [
            'index' => 'admin.collaborations.index',
            'create' => 'admin.collaborations.create',
            'edit' => 'admin.collaborations.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.collaborations.index',
            'create' => 'admin.collaborations.create',
            'edit' => 'admin.collaborations.edit',
            'delete' => 'admin.collaborations.delete'
        ];
    }
    public function index(CollaborationDataTable $dataTable)
    {

        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('customerRegister'), route($this->route['index']))
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(__('customerRegister'), route($this->route['index']))->add(__('addCustomerRegister')),
        ]);
    }

    public function store(CustomerRegistrationsRequest $request)
    {

        $response = $this->service->store($request);
        if ($response) {

            return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'))->with('hideFields', true);
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id)
    {
        $response = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'customerRegistrations' => $response,
                'breadcrumbs' => $this->crums->add(__('customerRegister'), route($this->route['index']))->add(__('editCustomerRegister')),
            ]
        );
    }

    public function update(CustomerRegistrationsRequest $request)
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
