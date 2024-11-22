<?php

namespace App\Api\V1\Services\Auth;

use App\Admin\Repositories\BankInformation\BankInformationRepositoryInterface;
use App\Admin\Services\File\FileService;
use App\Api\V1\Mail\Auth\OtpMail;
use App\Api\V1\Services\Auth\AuthServiceInterface;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;
use App\Api\V1\Support\AuthSupport;
use App\Enums\User\UserGender;
use App\Enums\User\UserRoles;
use App\Enums\User\UserVip;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AuthService implements AuthServiceInterface
{
    use Setup;
    use AuthSupport;
    protected FileService $fileService;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    protected $bankRepoistory;

    protected $instance;

    public function __construct(
        UserRepositoryInterface $repository,
        FileService $fileService,
        BankInformationRepositoryInterface $bankRepoistory,
    ) {
        $this->repository = $repository;
        $this->fileService = $fileService;
    }
    public function UpdateInformation(Request $request, $id)
    {
        $validatedData = $request->validated();
        $validatedData['phone'] = $request->phone;
        $validatedData['email'] = $request->email;
        $validatedData['fullname'] = $request->fullname;
        $validatedData['gender'] = $request->gender;
        $validatedData['birthday'] = $request->birthday;

        $auth = $this->repository->find($id);

        if ($request->has('avatar')) {
            $validatedData['avatar'] = $this->fileService->uploadAvatar('users/' . $id, $request->file('avatar'), $auth);
        }


        return $this->repository->update($id, $validatedData);
    }
    public function store(Request $request)
    {
        $otp = $this->generateOtp();
        $this->data = $request->validated();
        $this->data['username'] = $this->data['phone'];
        $this->data['code'] = $this->createCodeUser();
        $this->data['otp'] = $otp;
        $this->data['CreatedOtp'] = now();
        $this->data['roles'] = UserRoles::Seller;
        $this->data['gender'] = UserGender::Male;
        $this->data['active'] = false;
        $this->data['password'] = bcrypt($this->data['password']);
        if (!empty(($this->data['referal_code']))) {
            $referalUser = $this->repository->findByColumn('code', $this->data['referal_code']);
            if ($referalUser) {
                $this->data['parent_id'] = $referalUser->id;
            } else {
                return [
                    'status' => 404,
                    'message' => __('Không tồn tại hoặc sai mã giới thiệu')
                ];
            }
        }
        $createdUser = $this->repository->create($this->data);
        $userId = $createdUser->id;
        $auth = $this->repository->find($userId);
        if ($request->hasFile('cccd_front_image')) {
            $frontImage = $request->file('cccd_front_image');
            $frontImageName = time() . '_front_' . $frontImage->getClientOriginalName();

            $this->data['cccd_front_image'] = $this->fileService->uploadAvatar('users/' . $userId, $frontImage, $auth, $frontImageName);
        }
        if ($request->hasFile('cccd_back_image')) {

            $BackImage = $request->file('cccd_back_image');
            $backImageName = time() . '_back_' . $BackImage->getClientOriginalName();
            $this->data['cccd_back_image'] = $this->fileService->uploadAvatar('users/' . $userId, $BackImage, $auth, $backImageName);
        }
        $createdUser->cccd_number = $request->cccd_number;
        $createdUser->issued_by = $request->issued_by;
        $createdUser->issued_day = $request->issued_day;
        $createdUser->save();
        Mail::to($this->data['email'])->send(new OtpMail($otp));
        return [
            'status' => 200,
            'message' => __('Tạo tài khoản thành công vui lòng kiểm tra Email')
        ];
    }
    public function UpdateCCCd(Request $request, $id)
    {
        $this->data = $request->validated();
        $auth = $this->repository->find($id);
        if ($request->hasFile('cccd_front_image')) {
            $frontImage = $request->file('cccd_front_image');
            $frontImageName = time() . '_front_' . $frontImage->getClientOriginalName();

            $this->data['cccd_front_image'] = $this->fileService->uploadAvatar('users/' . $id, $frontImage, $auth, $frontImageName);
        }
        if ($request->hasFile('cccd_back_image')) {

            $BackImage = $request->file('cccd_back_image');
            $backImageName = time() . '_back_' . $BackImage->getClientOriginalName();
            $this->data['cccd_back_image'] = $this->fileService->uploadAvatar('users/' . $id, $BackImage, $auth, $backImageName);
        }

        $this->data['cccd_number'] = $request->cccd_number;
        $this->data['issued_by'] = $request->issued_by;
        $this->data['issued_day'] = $request->issued_day;

        return $this->repository->update($id, $this->data);
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

    public function updateTokenPassword(Request $request)
    {
        $user = $this->repository->findByKey('email', $request->input('email'));
        $this->data['token_get_password'] = $this->generateTokenGetPassword();
        $this->instance['user'] = $this->repository->updateObject($user, $this->data);
        return $this;
    }

    public function generateRouteGetPassword($routeName)
    {
        $this->instance['url'] = URL::temporarySignedRoute(
            $routeName,
            now()->addMinutes(30),
            [
                'token' => $this->data['token_get_password'],
                'code' => $this->instance['user']->code
            ]
        );
        return $this;
    }

    public function getInstance()
    {
        return $this->instance;
    }
    public function CheckOtp(Request $request)
    {

        $checkotp = $this->repository->CheckOtp($request->email, $request->otp);


        return $checkotp;
    }

    public function addBank(Request $request)
    {
        return 'hahaha';
    }
}
