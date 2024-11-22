<?php

namespace App\Admin\Http\Controllers\User;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\User\UserRequest;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Admin\Services\User\UserServiceInterface;
use App\Admin\DataTables\User\UserDataTable;
use App\Admin\Http\Requests\Bank_Information\BankInformationRequest;
use App\Admin\Repositories\BankInformation\BankInformationRepositoryInterface;
use App\Enums\CommissionDetail\CommissionDetailStatus;
use App\Enums\CommissionDetail\CommissionDetailType;
use App\Enums\User\{UserRoles, UserVip, UserGender, UserStatus, UserIdentifier};
use App\Admin\Repositories\CustomerRegistrations\CustomerRegistrationsRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected BankInformationRepositoryInterface $bankInformationRepository;
    protected $customerRegistrationsRepository;
    public function __construct(
        UserRepositoryInterface $repository,
        UserServiceInterface $service,
        BankInformationRepositoryInterface $bankInformationRepository,
        CustomerRegistrationsRepositoryInterface $customerRegistrationsRepository
    ) {

        parent::__construct();

        $this->repository = $repository;

        $this->service = $service;
        $this->bankInformationRepository = $bankInformationRepository;
        $this->customerRegistrationsRepository = $customerRegistrationsRepository;
    }

    public function getView()
    {
        return [
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'edit' => 'admin.users.edit',
            'AddPayment' => 'admin.banks.create',
            'EditPayment' => 'admin.banks.edit',
            'commission' => 'admin.users.partials.commissions_list'
        ];
    }

    public function getRoute()
    {
        return [
            'index' => 'admin.user.index',
            'create' => 'admin.user.create',
            'edit' => 'admin.user.edit',
            'delete' => 'admin.user.delete',
            'AddPayment' => 'admin.bank.create',
        ];
    }
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'roles' => UserRoles::asSelectArray(),
            'vip' => UserVip::asSelectArray(),
            'gender' => UserGender::asSelectArray()
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'roles' => UserRoles::asSelectArray(),
            'vip' => UserVip::asSelectArray(),
            'gender' => UserGender::asSelectArray()
        ]);
    }
    public function AddBankInformation(BankInformationRequest $request)
    {

        $instance = $this->service->AddPayment($request);

        return to_route($this->route['edit'], $instance->id_user);
    }
    public function store(UserRequest $request)
    {

        $instance = $this->service->store($request);

        return to_route($this->route['edit'], $instance->id);
    }
    public function EditPayment($id)
    {
        $instance = $this->bankInformationRepository->findOrFail($id);
        return view($this->view['EditPayment'], [
            'bank' => $instance
        ]);

    }
    public function AddPayInformation($id)
    {
        $instance = $this->repository->findOrFail($id);
        return view($this->view['AddPayment'], [
            'user' => $instance
        ], );
    }
    public function edit($id, Request $request)
    {
        $instance = $this->repository->findOrFail($id);
        $bank = $this->bankInformationRepository->GetBankInformationByUserId($id);
        $Parent = $this->repository->GetUserByParentId((int) $id);

        $commission = $instance->commission()->paginate(4);

        $totalDirect = $instance->sumPaidAmountByType(CommissionDetailType::directCommission);
        $totalIndriect = $instance->sumPaidAmountByType(CommissionDetailType::inDirectCommission);
        
        if ($request->ajax()) {
            return view($this->view['commission'], ['commission' => $commission]);
        }

        return view(
            $this->view['edit'],
            [
                'user' => $instance,
                'roles' => UserRoles::asSelectArray(),
                'vip' => UserVip::asSelectArray(),
                'gender' => UserGender::asSelectArray(),
                'bank' => $bank,
                'totalDirect' => $totalDirect,
                'totalIndirect' => $totalIndriect,
                'parent' => $Parent,
                'commission' => $commission,
                'identifier' => UserIdentifier::asSelectArray(),
                'Active' => UserStatus::asSelectArray(),
            ],
        );

    }

    public function UpdatePayment(BankInformationRequest $request)
    {

        $this->service->UpdatePayment($request);
        return back()->with('success', __('notifySuccess'));

    }
    public function update(UserRequest $request)
    {
        // dd($request);
        $this->service->update($request);

        return back()->with('success', __('notifySuccess'));

    }

    public function delete($id)
    {

        $this->service->delete($id);

        return to_route($this->route['index'])->with('success', __('notifySuccess'));

    }
}
