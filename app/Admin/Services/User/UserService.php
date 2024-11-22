<?php

namespace App\Admin\Services\User;

use App\Admin\Repositories\BankInformation\BankInformationRepositoryInterface;
use App\Admin\Services\File\FileService;
use App\Admin\Services\User\UserServiceInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Enums\User\UserVip;

use Illuminate\Http\Request;
use App\Admin\Traits\Setup;
use App\Enums\User\UserRoles;
use App\Models\BankInformation;
use Illuminate\Support\Facades\Log;

class UserService implements UserServiceInterface
{
    use Setup;
    protected FileService $fileService;

    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    protected $repositoryBank;

    public function __construct(
        UserRepositoryInterface $repository,
        FileService $fileService,
        BankInformationRepositoryInterface $bankInformationRepository,
    ) {
        $this->repository = $repository;
        $this->fileService = $fileService;

        $this->repositoryBank = $bankInformationRepository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        $this->data['username'] = $this->data['phone'];
        $this->data['code'] = $this->createCodeUser();
        $this->data['password'] = bcrypt($this->data['password']);


        if (!empty($this->data['referal_code'])) {
            $referalUser = $this->repository->findByColumn('code', $this->data['referal_code']);
            if ($referalUser) {
                $this->data['parent_id'] = $referalUser->id;
            }
        }
        $result = $this->repository->create($this->data);

        return $result;
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();

        if (isset($this->data['password']) && $this->data['password']) {
            $this->data['password'] = bcrypt($this->data['password']);
        } else {
            unset($this->data['password']);
        }
        return $this->repository->update($this->data['id'], $this->data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
    public function AddPayment(Request $request)
    {
        $validatedData = $request->validated();
        $addPayment = BankInformation::create($validatedData);
        return $addPayment;
    }
    public function UpdatePayment(Request $request)
    {
        $validated = $request->validated();
        $updatepayment = BankInformation::where('id', $validated['id'])->update($validated);
        return $updatepayment;
    }
}
