<?php

namespace App\Admin\Http\Controllers\CustomerRegistrations;

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
use App\Admin\Repositories\CommissionDetail\CommissionDetailRepositoryInterface;
use App\Enums\CommissionDetail\CommissionDetailType;
use App\Enums\CustomerRegistration\CustomerRegistrationStatus;
use App\Enums\CustomerRegistration\CustomerRegistrationType;


class CustomerRegistrationsController extends Controller
{
    protected $commissionRepository;
    protected $commissionDetailRepository;
    public function __construct(
        CustomerRegistrationsRepositoryInterface $repository,
        CustomersRepositoryInterface $customersRepository,
        ArticlesRepositoryInterface $articlesRepository,
        CustomerRegistrationsServiceInterface $service,
        CommissionRepositoryInterface $commissionRepository,
        CommissionDetailRepositoryInterface $commissionDetailRepository,
    ) {

        parent::__construct();

        $this->repository = $repository;
        $this->customersRepository = $customersRepository;
        $this->articlesRepository = $articlesRepository;
        $this->service = $service;
        $this->commissionRepository = $commissionRepository;
        $this->commissionDetailRepository = $commissionDetailRepository;
    }

    public function getView()
    {
        return [
            'index' => 'admin.customerRegistrations.index',
            'create' => 'admin.customerRegistrations.create',
            'edit' => 'admin.customerRegistrations.edit'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.customerRegistration.index',
            'create' => 'admin.customerRegistration.create',
            'edit' => 'admin.customerRegistration.edit',
            'delete' => 'admin.customerRegistration.delete'
        ];
    }
    public function index(CustomerRegistrationsDataTable $dataTable)
    {

        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('customerRegister'), route($this->route['index'])),
            'status' => CustomerRegistrationStatus::asSelectArray(),
        ]);
    }

    public function article($article_id, CustomerRegistrationByArticlesDataTable $dataTable)
    {
        $article = $this->articlesRepository->find($article_id);
        return $dataTable->with('article', $article)->render($this->view['index'], [
            'status' => CustomerRegistrationStatus::asSelectArray(),
            'breadcrumbs' => $this->crums->add(__('customerRegister'), route($this->route['index'])),
            'article' => $article,
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'status' => CustomerRegistrationStatus::asSelectArray(),
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
        $customerinfo = $this->customersRepository->find($response->user_id);
        $articleinfo = $this->articlesRepository->find($response->article_id);
        $commission = $this->commissionRepository->find($articleinfo->commission_id);
        $customerRegistrations = $this->commissionDetailRepository->getComissionDetail($response->id);

        $cmDetailDirect = $customerRegistrations->filter(function ($item) {
            return $item->type == CommissionDetailType::directCommission;
        })->first();

        $cmDetailIndirect = $customerRegistrations->filter(function ($item) {
            return $item->type == CommissionDetailType::inDirectCommission;
        })->first();

        $commissionIndirect =
            $commission->indirect_commission * $response->amount_sold / 100;

        $commissionDirect =
            $commission->direct_commission * $response->amount_sold / 100;

        return view(
            $this->view['edit'],
            [
                'customerRegistrations' => $response,
                'customerinfo' => $customerinfo,
                'articleinfo' => $articleinfo,
                'cmIndirect' => $commissionIndirect,
                'cmDirect' => $commissionDirect,
                'indirect' => $cmDetailIndirect,
                'direct' => $cmDetailDirect,
                'status' => CustomerRegistrationStatus::asSelectArray(),
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
