<?php

namespace App\Admin\Http\Controllers\ContactAdmin;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\ContactAdmin\ContactAdminRequest;
use App\Admin\Repositories\ContactAdmin\ContactAdminRepositoryInterface;
use App\Admin\Services\ContactAdmin\ContactAdminServiceInterface;
use App\Admin\DataTables\ContactAdmin\ContactAdminDataTable;


class ContactAdminController extends Controller
{
    public function __construct(
        ContactAdminRepositoryInterface $repository, 
        ContactAdminServiceInterface $service
    ){

        parent::__construct();

        $this->repository = $repository;

        
        $this->service = $service;
        
    }

    public function getView(){
        return [
            'index' => 'admin.ContactAdmin.index',
            'create' => 'admin.ContactAdmin.create',
            'edit' => 'admin.ContactAdmin.edit'
        ];
    }

    public function getRoute(){
        return [
            'index' => 'admin.ContactAdmin.index',
            'create' => 'admin.ContactAdmin.create',
            'edit' => 'admin.ContactAdmin.edit',
            'delete' => 'admin.ContactAdmin.delete'
        ];
    }
    public function index(ContactAdminDataTable $dataTable){
        return $dataTable->render($this->view['index']);
    }

    public function create(){

        return view($this->view['create']);
    }

    public function store(ContactAdminRequest $request){

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
                'contactAdmin' => $response
            ]
        );

    }
 
    public function update(ContactAdminRequest $request){

        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id){

        $this->service->delete($id);
        
        return to_route($this->route['index'])->with('success', __('notifySuccess'));
        
    }
}