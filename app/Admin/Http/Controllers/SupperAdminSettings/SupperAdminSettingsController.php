<?php

namespace App\Admin\Http\Controllers\SupperAdminSettings;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\SupperAdminSettings\SupperAdminSettingsRequest;
use App\Admin\Repositories\SupperAdminSettings\SupperAdminSettingsRepositoryInterface;
use App\Admin\Services\SupperAdminSettings\SupperAdminSettingsServiceInterface;
use App\Admin\DataTables\SupperAdminSettings\SupperAdminSettingsDataTable;


class SupperAdminSettingsController extends Controller
{
    public function __construct(
        SupperAdminSettingsRepositoryInterface $repository, 
        SupperAdminSettingsServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;

        
        $this->service = $service;
        
    }

    public function getView(){
        return [
            'index' => 'admin.supperAdminSettings.index',
            'create' => 'admin.supperAdminSettings.create',
            'edit' => 'admin.supperAdminSettings.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.supperAdminettings.index',
            'create' => 'admin.supperAdmin_settings.create',
            'edit' => 'admin.supperAdmin_settings.edit',
            'delete' => 'admin.supperAdmin_settings.delete'
        ];
    }
    public function index(SupperAdminSettingsDataTable $dataTable){
        return $dataTable->render($this->view['index']);
    }

    public function create(){

        return view($this->view['create']);
    }

    public function store(SupperAdminSettingsRequest $request){

        $response = $this->service->store($request);
        if($response){
            return to_route($this->route['edit'], $response->id)->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'))->withInput();
    }

    public function edit($id){
        $response = $this->repository->findOrFail($id);
        return view(
            $this->view['edit'],
            [
                'supperAdmin_settings' => $response
            ]
        );

    }
 
    public function update(SupperAdminSettingsRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }
}