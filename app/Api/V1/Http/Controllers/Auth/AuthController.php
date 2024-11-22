<?php

namespace App\Api\V1\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Auth\OtpRequest;
use App\Api\V1\Http\Requests\Auth\{BankRequest, RegisterRequest, LoginRequest, UpdateCCcdRequest, UpdateRequest, UpdatePasswordRequest};
use App\Api\V1\Http\Resources\Auth\ChildDetailResource;
use App\Api\V1\Http\Resources\Auth\CommissionResource;
use App\Api\V1\Http\Resources\Bank\BankResource;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Services\Auth\AuthServiceInterface;
use App\Api\V1\Services\BankInformation\BankInformationService;
use App\Traits\JwtService;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Request;
use App\Api\V1\Http\Resources\Auth\AuthResource;
use App\Api\V1\Http\Resources\Auth\ChildResource;
use App\Api\V1\Repositories\BankInformation\BankInformationRepositoryInterface;
use App\Api\V1\Services\BankInformation\BankInformationServiceInterface;
use App\Api\V1\Support\AuthServiceApi;
use App\Api\V1\Support\Response;
use App\Traits\UseLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\Check;

/**
 * @group Người dùng
 */

class AuthController extends Controller
{

    use JwtService, Response, AuthServiceApi, UseLog;
    protected $auth;
    //
    private $login;
    protected $bankService;
    protected $bankRepoistory;
    public function __construct(
        UserRepositoryInterface $repository,
        AuthServiceInterface $service,
        BankInformationServiceInterface $bankService,
        BankInformationRepositoryInterface $bankRepository,
    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->bankService = $bankService;
        $this->bankRepoistory = $bankRepository;
        $this->middleware('auth:api', ['except' => ['login', 'register', 'CheckOtp', 'ResendOtp']]);
    }

    protected function resolve()
    {

        if (empty($this->login['email']) || empty($this->login['password'])) {
            Log::error('Email or password is missing in login data.');
            return false;
        }

        $user = $this->repository->findByField('email', $this->login['email']);
        if ($user && Hash::check($this->login['password'], $user->password)) {
            Auth::login($user);
            return true;
        }

        return false;
    }

    /**
     * Lấy thông tin thành viên
     *
     *
     * Lấy user hiện tại thông qua access_token. Trong đó có:
     * <ul>
     * <li><strong>id:</strong>Id user của bạn</li>
     * <li><strong>username:</strong>Username của bạn</li>
     * <li><strong>FullName:</strong>FullName của bạn</li>
     * <li><strong>Email:</strong>Email của bạn</li>
     * <li><strong>Avatar:</strong>Avatar Của bạn</li>
     * <li><strong>Birthday:</strong>Sinh nhật của bạn</li>
     * <li><strong>Phone:</strong>Số điện thoại của bạn</li>
     * <li><strong>Address:</strong>Địa chỉ của bạn</li>
     * <li><strong>gender</strong>:
     *      <ul>
     *          <li>1: Nam</li>
     *          <li>2: Nữ</li>
     *          <li>3: Khác</li>
     *      </ul>
     * </li>
     *<li><strong>cccd_front_image:</strong>Mặt trước căn cước công dân</li>
     *<li><strong>cccd_back_image:</strong>Mặt sau căn cước công dân</li>
     *<li><strong>cccd_number:</strong>Số căn cước công dân</li>
     *<li><strong>issued_by:</strong>Nơi cấp căn cước công dân</li>
     *<li><strong>issued_day:</strong>Ngày cấp căn cước công dân</li>
     *<li><strong>created_at:</strong>Thời gian tạo</li>
     *<li><strong>children:</strong>Cấp dưới của bạn</li>
     *<li><strong>article_register:</strong> Số lượng đăng ký dự án</li>
     * </ul>
     *
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     *
     * @response {
     * "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *           "id": 25,
     *           "username": "0987634333",
     *           "fullname": "Hello1",
     *           "email": "truog@gmai1l.com",
     *           "avatar":"http://localhost:8080/appbds/public/uploads/users/25/hkRyoqxgrG83tnQGZnOoKj8lYfpr9qO39vLHKAIP.jpg",
     *            "birthday":"2002-07-22",
     *           "phone": "0914517322",
     *           "address": null,
     *           "gender": 1,
     *            "roles":1,
     *            "cccd_front_image":"http://localhost:8080/appbds/public/uploads/users/25/ccEdH3PNtRu2kMfGv1VT5r7eVYaRLiwe50WOJwZY.jpg",
     *             "cccd_back_image":"http://localhost:8080/appbds/public/uploads/users/25/7z900lzZh6JSHBMEo3Dx01zW1I16huZqiielIoZc.jpg",
     *             "cccd_number":"079203026820",
     *              "issued_by":"Cuc truong canh sat",
     *               "issued_day":"2003-07-25",
     *           "created_at": "2023-03-26T06:41:42.000000Z",
     *              "children":[]
     *       }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = $request->user()->load('children', 'bank', 'article_register');
        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => new AuthResource($user)
        ]);
    }
    /**
     * Đăng ký
     *
     * Tạo mới 1 user.
     *
     * @bodyParam fullname string required Họ và tên thành viên. Example: Nguyễn Văn A
     *
     * @bodyParam phone string required Số điện thoại thành viên. Example: 0999999999
     *
     * @bodyParam email string required Email của thành viên. Example: abc@gmail.com
     *
     * @bodyParam referal_code string Mã giới thiệu của Thành viên. Example: U6E8EE1730526619
     *
     * @bodyParam password string required Mật khẩu. Example: 123456
     *
     * @bodyParam password_confirmation string required Xác nhận mật khẩu. Example: 123456
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Tạo tài khoản thành công vui lòng kiểm tra Email"
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Thực hiện không thành công."
     * }
     *
     * @param  App\Api\V1\Http\Requests\Auth\RegisterRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $instance = $this->service->store($request);
        if ($instance) {
            return response()->json([
                'status' => $instance['status'],
                'message' => $instance['message']
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('Thực hiện không thành công.')
        ], 400);
    }
    /**
     * Đăng nhập
     *
     * Đăng nhập tài khoản.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam email string required
     * Email đăng ký tài khoản. Example: example@gmail.com
     *
     * @bodyParam password string required
     * Mật khẩu của bạn. Example: 123456
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Đăng nhập thành công.",
     *      "access_token": "1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K"
     * }
     * @response 401 {
     *      "status": 401,
     *      "message": "Tài khoản hoặc mật khẩu không đúng."
     * }
     *
     * @param  App\Api\V1\Http\Requests\Auth\LoginRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        // Log::info('Request', ['phone' => $request->phone, 'password' => $request->password]);
        try {
            $user = $this->repository->findByKey('email', $request->email);
            if (!$user) {
                return $this->jsonResponseError('Không tìm thấy người dùng');
            }

            // Check if the user is active
            if (!$user->active == 1) {
                return $this->jsonResponseError('Tài khoản chưa được nhập mã kích hoạt! Vui lòng kiểm tra email');
            }

            return $this->loginUser($request);
        } catch (Exception $e) {
            $this->logError("Login failed", $e);
            return $this->jsonResponseError($e->getMessage());
        }
    }

    /**
     * Cập nhật CCCD
     * @bodyParam cccd_number file required
     * số căn cước công dân của bản. Example:079203026826
     * @bodyParam cccd_front_image file required
     * Mặt trước căn cước công dân của bạn.
     * @bodyParam ccd_back_image file required
     * Mặt sau căn cước công dân của bạn
     * @bodyParam issued_by string required
     * Nơi cấp cccd của bạn
     * @bodyParam issued_day string required
     * Ngày Cấp cccd của bạn
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *   "data": {
     * "id": 5,
     *   "code": "U5F75C1729483219",
     *  "username": "0924517304",
     *  "fullname": "Trần Nguyễn Thanh Phong",
     * "email": "admin@gmail.com",
     *  "phone": "0924517304",
     *  "birthday":"2002-07-22",
     *  "address": "331/34 Lê văn sỹ phường 13 quận 3",
     *   "avatar": "http://localhost:8080/appbds/public/uploads/users/25/pljSCJRyWhTd4Gw7wDicWDCTzMPWgM6wWT1t8TBp.jpg",
     *   "gender": 1,
     *   "email_verified_at": null,
     *  "token_get_password": null,
     * "active": true,
     *  "status": 1,
     * "device_token": null,
     * "roles": 1,
     * "vip": 2,
     *  "parent_id": null,
     * "created_at": "2024-10-21T04:00:19.000000Z",
     *  "updated_at": "2024-10-21T04:22:02.000000Z",
     * "cccd_front_image": "http://localhost:8080/appbds/public/uploads/users/25/ccEdH3PNtRu2kMfGv1VT5r7eVYaRLiwe50WOJwZY.jpg",
     * "cccd_back_image":  "http://localhost:8080/appbds/public/uploads/users/25/7z900lzZh6JSHBMEo3Dx01zW1I16huZqiielIoZc.jpg",
     * "cccd_number": "079203026820",
     * "issued_by": "Cuc truong canh sat",
     * "issued_day": "2003-07-25",
     * "otp": null,
     *   "CreatedOtp": null
     * }
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Thực hiện không thành công."
     * }
     *
     * @param  App\Api\V1\Http\Requests\Auth\RegisterRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateCCCd(UpdateCCcdRequest $Request)
    {
        try {
            $response = $this->service->updateCCcd($Request, $Request->user()->id);
            if (isset($response['cccd_front_image'])) {
                $response['cccd_front_image'] = asset($response['cccd_front_image']);
            }
            if (isset($response['avatar'])) {
                $response['avatar'] = asset($response['avatar']);
            }
            if (isset($response['cccd_back_image'])) {
                $response['cccd_back_image'] = asset($response['cccd_back_image']);
            }
            return response()->json([
                'message' => 'CCCD updated successfully',
                'data' => $response


            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update CCCD',
                'error' => $e->getMessage()
            ], 400);
        }
    }
    /**
     * Cập nhật Thông tin user
     * @bodyParam fullname string required
     * Tên của bạn.
     * @bodyParam email string required
     * email của bạn.
     * @bodyParam gender string required
     * giới tính của bạn
     * @bodyParam phone string
     * số điện thoại của bạn

     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *   "data": {
     * "id": 5,
     *   "code": "U5F75C1729483219",
     *  "username": "0924517304",
     *  "fullname": "Trần Nguyễn Thanh Phong",
     * "email": "admin@gmail.com",
     *  "phone": "0924517304",
     *  "birthday":"2002-07-22",
     *  "address": "331/34 Lê văn sỹ phường 13 quận 3",
     *   "avatar": "http://localhost:8080/appbds/public/uploads/users/25/pljSCJRyWhTd4Gw7wDicWDCTzMPWgM6wWT1t8TBp.jpg",
     *   "gender": 1,
     *   "email_verified_at": null,
     *  "token_get_password": null,
     * "active": true,
     *  "status": 1,
     * "device_token": null,
     * "roles": 1,
     * "vip": 2,
     *  "parent_id": null,
     * "created_at": "2024-10-21T04:00:19.000000Z",
     *  "updated_at": "2024-10-21T04:22:02.000000Z",
     * "cccd_front_image": "http://localhost:8080/appbds/public/uploads/users/25/ccEdH3PNtRu2kMfGv1VT5r7eVYaRLiwe50WOJwZY.jpg",
     * "cccd_back_image":  "http://localhost:8080/appbds/public/uploads/users/25/7z900lzZh6JSHBMEo3Dx01zW1I16huZqiielIoZc.jpg",
     * "cccd_number": "079203026820",
     * "issued_by": "Cuc truong canh sat",
     * "issued_day": "2003-07-25",
     * "otp": null,
     *   "CreatedOtp": null
     * }
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Thực hiện không thành công."
     * }
     *
     * @param  App\Api\V1\Http\Requests\Auth\UpdateRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        try {
            $response = $this->service->UpdateInformation($request, $request->user()->id);
            if (isset($response['cccd_front_image'])) {
                $response['cccd_front_image'] = asset($response['cccd_front_image']);
            }
            if (isset($response['avatar'])) {
                $response['avatar'] = asset($response['avatar']);
            }
            if (isset($response['cccd_back_image'])) {
                $response['cccd_back_image'] = asset($response['cccd_back_image']);
            }
            return response()->json([
                'message' => 'Update Information successfully',
                'data' => $response
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update CCCD',
                'error' => $e->getMessage()
            ], 400);
        }
    }
    /**
     * Cập nhật mật khẩu
     *
     * Cập nhật mật khẩu user hiện tại.
     *
     * @bodyParam old_password string required
     * Mật khẩu cũ của bạn. Example: 123
     *
     * @bodyParam password string required
     * Mật khẩu của bạn. Example: 123456
     *
     * @bodyParam password_confirmation string required
     * Nhập lại mật khẩu của bạn. Example: 123456
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @response {
     *      "status": 200,
     *      "message": "Thực hiện thành công."
     * }
     *
     * @param  App\Api\V1\Http\Requests\Auth\UpdatePasswordRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $password = bcrypt($request->input('password'));
        $user = $request->user();
        $user->update([
            'password' => $password
        ]);
        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
        ], 200);
    }
    /**
     * ResendOtp
     *
     * Gửi và Cấp lại Otp
     *
     * @bodyParam email string required
     * Email của bạn. Example: tranp6648@gmail.com

     * @response {
     *      "status": 200,
     *      "message": "Mã OTP đã được gửi thành công."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */


    public function ResendOtp(Request $request)
    {
        $email = $request->input('email');
        $response = $this->repository->SendOtp($email);
        try {
            if ($response === true) {
                return response()->json([
                    'status' => 200,
                    'message' => __('Mã OTP đã được gửi thành công'),


                ]);
            } else {
                return response()->json([
                    'message' => 'Failed to Check Otp',
                    'error' => $response,

                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to Check Otp',
                'error' => $e->getMessage(),

            ], 400);
        }
    }
    /**
     * CheckOtp
     *
     * Kiểm tra Otp để kích hoạt tài khoản
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam email string required Email của bạn. Example: abc@gmail.com
     * @bodyParam otp string required Mã otp được cấp bên email. Example: 12345
     *
     *
     * @response {
     *      "status": 200,
     *       "message": "Thực hiện thành công.",
     *        "response": "Kiểm tra thành công Otp"
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function CheckOtp(OtpRequest $request)
    {
        $response = $this->service->CheckOtp($request);
        try {
            if ($response == "Kiểm tra thành công Otp") {
                return response()->json([
                    'status' => 200,
                    'message' => __('Thực hiện thành công.'),
                    'response' => $response
                ]);
            } else {
                return response()->json([
                    'message' => 'Failed to Check Otp',
                    'error' => $response,

                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to Check Otp',
                'error' => $e->getMessage(),
                'date' => $response
            ], 400);
        }
    }

    /**
     * Đăng xuất
     *
     * Đăng xuất tài khoản
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated
     *
     * @response {
     *      "status": 200,
     *       "message": "Thực hiện thành công.",
     *        "response": "Đăng xuất thành công"
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'status' => 200,
                'message' => __('Đăng xuất thành công'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Có lỗi xảy ra khi đăng xuất'),
                'error' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Thêm tài khoản thanh toán
     *
     * Tạo mới thông tin thanh toán.
     * @authenticated
     * @bodyParam id integer required ID Thông tin thanh toán. Example: 1
     * @bodyParam bank_name string Tên ngân hàng. Example: VCB
     * @bodyParam bank_branch string Chi nhánh ngân hàng. Example: PGD Lý Thường Kiệt
     * @bodyParam bank_account string Tên tài khoản. Example: Nguyen Van A
     * @bodyParam bank_number string Số tài khoản. Example: 1234567890
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Tạo tài khoản thành công vui lòng kiểm tra Email"
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Thực hiện không thành công."
     * }
     *
     * @param  App\Api\V1\Http\Requests\Bank\BankRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function addBank(BankRequest $data)
    {
        $instance = $this->bankService->add($data);
        if ($instance) {
            return response()->json([
                'status' => $instance['status'],
                'message' => $instance['message']
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('Thực hiện không thành công.')
        ], 400);
    }


    /**
     * Chỉnh sửa thông tin thanh toán
     *
     * Chỉnh sửa thông tin thanh toán
     *
     * @bodyParam id integer required ID Thông tin thanh toán. Example: 1
     * @bodyParam bank_name string Tên ngân hàng. Example: VCB
     * @bodyParam bank_branch string Chi nhánh ngân hàng. Example: PGD Lý Thường Kiệt
     * @bodyParam bank_account string Tên tài khoản. Example: Nguyen Van A
     * @bodyParam bank_number string Số tài khoản. Example: 1234567890
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Đã cập nhật thành công thông tin thanh toán"
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Thực hiện không thành công."
     * }
     *
     * @param  App\Api\V1\Http\Requests\Bank\BankRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function editBank(BankRequest $data)
    {
        try {
            $instance = $this->bankService->update($data);
            return response()->json([
                'status' => $instance['status'],
                'message' => $instance['message']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => __('Thực hiện không thành công.') . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Xóa thông tin thanh toán
     *
     * Xóa thông tin thanh toán
     *
     * @bodyParam id integer required id của TTTT. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Xóa thành công thông tin thanh toán"
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Thực hiện không thành công."
     * }
     *
     * @param  App\Api\V1\Http\Requests\Bank\BankRequest  $request
     *
     * @return \Illuminate\Http\Response
     */

    public function deleteBank(Request $request)
    {
        try {
            $id = $request->input('id');
            $response = $this->bankRepoistory->delete($id);

            return response()->json([
                'status' => 200,
                'message' => __('Xóa thành công.')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Xóa thất bại.') . $e->getMessage()
            ]);
        }
    }

    /**
     * Xem chi tiết thông tin thanh toán
     *
     * Chi tiết thông tin thanh toán
     *
     * @authenticated
     *
     * @bodyParam id integer required id của TTTT. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thông tin thanh toán"
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Thực hiện không thành công."
     * }
     *
     * @param  App\Api\V1\Http\Requests\Bank\BankRequest  $request
     *
     * @return \Illuminate\Http\Response
     */

    public function showBank($id)
    {
        try {
            $bank = $this->bankRepoistory->find($id);
            $data = new BankResource($bank);
            if ($bank) {
                return response()->json([
                    'status' => 200,
                    'message' => __('Thực hiện thành công.'),
                    'data' => $data
                ], 200);
            }
            return response()->json([
                'status' => 404,
                'message' => __('Thông tin thanh toán này không tồn tại'),
            ], 404);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ], 500);
        }
    }


    /**
     * Xem chi tiết thông tin thành viên cấp dưới
     *
     * Chi tiết thông tin cấp dưới
     *
     * @pathParam id integer required id của Thành viên cấp dưới. Example: 1
     * @authenticated
     * @response 200 {
     *      "status": 200,
     *      "message": "Thông tin cấp dưới"
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Thực hiện không thành công."
     * }
     *
     * @param  App\Api\V1\Http\Requests\Bank\BankRequest  $request
     *
     * @return \Illuminate\Http\Response
     */

    public function showChild($id)
    {
        try {
            $parent = auth()->user()->id;
            $parent = $this->repository->checkUserChild($id, $parent);
            $data = new ChildDetailResource($parent);
            if ($parent) {
                return response()->json([
                    'status' => 200,
                    'message' => __('Thực hiện thành công.'),
                    'data' => $data
                ], 200);
            }
            return response()->json([
                'status' => 404,
                'message' => __('Thành viên này không thuộc quyền sở hữu của bạn!'),
            ], 404);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.') . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Xem chi tiết thông tin thành viên cấp dưới
     *
     * Chi tiết thông tin cấp dưới
     *
     * @pathParam id integer required id của Thành viên cấp dưới. Example: 1
     * @authenticated
     * @response 200 {
     *      "status": 200,
     *      "message": "Thông tin cấp dưới"
     * }
     * @response 400 {
     *      "status": 400,
     *      "message": "Thực hiện không thành công."
     * }
     *
     * @param  App\Api\V1\Http\Requests\Bank\BankRequest  $request
     *
     * @return \Illuminate\Http\Response
     */

    public function showChildAll()
    {
        try {
            $user = auth()->user()->id;
            $info = $this->repository->getAllCommissionsByUserIndirect($user);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $info
            ], 200);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.') . $e->getMessage()
            ], 500);
        }
    }
}
