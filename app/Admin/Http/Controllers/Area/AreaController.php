<?php

namespace App\Admin\Http\Controllers\Area;

use App\Admin\Http\Controllers\Controller;
use App\Admin\DataTables\Areas\AreasDataTable;
use App\Admin\Repositories\Areas\AreasRepository;
use App\Admin\Repositories\Areas\AreasRepositoryInterface;
use App\Admin\Services\Area\AreaService;
use App\Admin\Services\Area\AreaServiceInterface;
use App\Admin\Http\Requests\Areas\AreaRequest;
use App\Models\Areas;

class AreaController extends Controller
{
    public function __construct(
        AreasRepositoryInterface $repository,
        AreaServiceInterface $service,
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->service = $service;
    }


    public function getView()
    {
        return [
            'index' => 'admin.areas.index',
            'create' => 'admin.areas.create',
            'edit' => 'admin.areas.edit',
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.areas.index',
            'create' => 'admin.areas.create',
            'edit' => 'admin.areas.edit',
            'delete' => 'admin.areas.delete',
        ];
    }
    public function index(AreasDataTable $dataTable)
    {
        return $dataTable->render($this->view['index']);
    }

    public function create()
    {
        return view(
            $this->view['create'],
            []
        );
    }

    public function store(AreaRequest $request)
    {
        $response = $this->service->store($request);
        if ($response) {
            return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id)
    {
        $response = $this->repository->findOrFail($id);

     
        return view(
            $this->view['edit'],
            [
               
                'areas' => $response,
            ]
        );
    }



    public function update(AreaRequest $request)
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
