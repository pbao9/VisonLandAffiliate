<?php

namespace App\Admin\Http\Controllers\Commission;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Commission\CommissionRequest;
use App\Admin\Repositories\Commission\CommissionRepositoryInterface;
use App\Admin\Services\Commission\CommissionServiceInterface;
use App\Admin\DataTables\Commission\CommissionDataTable;


class CommissionController extends Controller
{
    public function __construct(
        CommissionRepositoryInterface $repository,
        CommissionServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;


        $this->service = $service;
    }

    public function getView()
    {
        return [
            'index' => 'admin.commission.index',
            'create' => 'admin.commission.create',
            'edit' => 'admin.commission.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.commission.index',
            'create' => 'admin.commission.create',
            'edit' => 'admin.commission.edit',
            'delete' => 'admin.commission.delete'
        ];
    }
    public function index(CommissionDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('listOfCommissions'), route($this->route['index'])),
        ]);
    }

    public function create()
    {

        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(__('commission'), route($this->route['index']))->add(__('addCommission')),
        ]);
    }

    public function store(CommissionRequest $request)
    {

        $response = $this->service->store($request);
        if ($response['success']) {
            return to_route($this->route['edit'], $response['id'])->with('success', $response['message']);
        }
        return back()->with('error', $response['message'])->withInput();
    }

    public function edit($id)
    {
        $response = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'commission' => $response,
                'breadcrumbs' => $this->crums->add(__('commission'), route($this->route['index']))->add(__('editCommission')),

            ]
        );
    }

    public function update(CommissionRequest $request)
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
