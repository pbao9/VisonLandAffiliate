<?php

namespace App\Admin\Http\Controllers\HouseType;

use App\Admin\DataTables\HouseType\HouseTypeDataTable;
use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\HouseTypes\HouseTypeRequest;
use App\Admin\Repositories\HouseType\HouseTypeRepositoryInterface;
use App\Admin\Services\HouseType\HouseTypeServiceInterface;

class HouseTypeController extends Controller
{
    public function __construct(
        HouseTypeRepositoryInterface $repository,
        HouseTypeServiceInterface $service
    ) {

        parent::__construct();

        $this->repository = $repository;

        $this->service = $service;
    }

    public function getView()
    {
        return [
            'index' => 'admin.houseTypes.index',
            'create' => 'admin.houseTypes.create',
            'edit' => 'admin.houseTypes.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.houses-type.index',
            'create' => 'admin.houses-type.create',
            'edit' => 'admin.houses-type.edit',
            'delete' => 'admin.houses-type.delete'
        ];
    }
    public function index(HouseTypeDataTable $dataTable)
    {
        return $dataTable->render($this->view['index']);
    }

    public function create()
    {
        return view($this->view['create']);
    }

    public function store(HouseTypeRequest $request)
    {
        $response = $this->service->store($request);
        if ($response) {
            return to_route($this->route['edit'], $response)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id)
    {
        $response = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'houseType' => $response,
            ]
        );
    }

    public function update(HouseTypeRequest $request)
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
