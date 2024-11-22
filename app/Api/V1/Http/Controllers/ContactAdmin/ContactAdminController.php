<?php

namespace App\Api\V1\Http\Controllers\ContactAdmin;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\ContactAdmin\ContactAdminRequest;
use App\Api\V1\Http\Resources\ContactAdmin\{AllContactAdminResource, ShowContactAdminResource};
use App\Api\V1\Repositories\ContactAdmin\ContactAdminRepositoryInterface;
use App\Api\V1\Services\ContactAdmin\ContactAdminServiceInterface;
use App\Api\V1\Services\ContactAdmin\ContactAdminService;



class ContactAdminController extends Controller
{
    public function __construct(
        ContactAdminRepositoryInterface $repository,
        ContactAdminServiceInterface $service
    )
    {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * DS Admin Liên hệ
     *
     * Lấy danh sách Contact_admin.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @queryParam page required The page number. Example: 1
     * 
     * @queryParam limit required The page number. Example: 10
     * 
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "admin_id": "Thông tin của Admin_id",
     *               "fullname": "Thông tin của Fullname",
     *               "phone": "Thông tin của Phone",
     *               "referral_code": "Thông tin của Referral_code",
     *               "status": "Thông tin của Status"
     *         }
     *      ]
     * }
	 * @response 400 {
     *      "status": 400,
     *      "message": "Vui lòng kiểm tra lại các trường field"
     * }
	 * @response 500 {
     *      "status": 500,
     *      "message": "Thực hiện thất bại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(ContactAdminRequest $request){
		try {
			$data = $request->validated();
			$contact_admins = $this->repository->paginate(...$data);
			$contact_admins = new AllContactAdminResource($contact_admins);
			return response()->json([
				'status' => 200,
				'message' => __('Thực hiện thành công.'),
				'data' => $contact_admins
			]);
		} catch (\Exception $e) {
			// Xử lý ngoại lệ nếu cần thiết
			return response()->json([
				'status' => 500,
				'message' => __('Thực hiện thất bại.')
			]);
		}
    }
    
    /**
     * Chi tiết Admin Liên hệ
     *
     * Lấy chi tiết Contact_admin
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @pathParam id integer required
     * ID
     * 
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "admin_id": "Thông tin của Admin_id",
     *               "fullname": "Thông tin của Fullname",
     *               "phone": "Thông tin của Phone",
     *               "referral_code": "Thông tin của Referral_code",
     *               "status": "Thông tin của Status"
     *         }
     *      ]
     * }
	 * @response 500 {
     *      "status": 500,
     *      "message": "Thực hiện thất bại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id){
		try {
			$contact_admin = $this->repository->findByID($id);
			$contact_admin = new ShowContactAdminResource($contact_admin);
			return response()->json([
				'status' => 200,
				'message' => __('Thực hiện thành công.'),
				'data' => $contact_admin
			]);
		} catch (\Exception $e) {
			// Xử lý ngoại lệ nếu cần thiết
			return response()->json([
				'status' => 500,
				'message' => __('Thực hiện thất bại.')
			]);
		}
    }
	
	
	
	/**
     * Xóa Contact_admin
     *
     * Xóa Contact_admin một Contact_admin theo ID
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @pathParam id integer required
     * id Contact_admin. Ví dụ: 1
     * 
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Xóa thành công."
     * }
	 * @response 500 {
     *      "status": 500,
     *      "message": "Xóa thất bại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request){
        
		$id = $request->input('id');
		$response = $this->repository->delete($id);
        
		if($response){
            return response()->json([
				'status' => 200,
				'message' => __('Xóa thành công.')
			]);
        }
        return response()->json([
				'status' => 500,
				'message' => __('Xóa thất bại.')
		]);
    }
    
    /**
     * Thêm Contact_admin
     *
     * Thêm một Contact_admin mới
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @pathParam admin_id BIGINT(20) required
     * Mã người quản lý
     * @pathParam fullname VARCHAR(191) required
     * Họ tên
     * @pathParam phone VARCHAR(191) required
     * Số điện thoại
     * @pathParam referral_code VARCHAR(191) required
     * Mã giới thiệu
     * @pathParam status INT(11) 
     * Trạng thái
     * 
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thêm thành công."
     * }
	 * @response 500 {
     *      "status": 500,
     *      "message": "Thêm thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function add(ContactAdminRequest $request)
    {
        $response = $this->service->add($request);
        if($response){
            return response()->json([
                'status' => 200,
                'message' => __('Thêm thành công.')
            ]);
        }
        return response()->json([
            'status' => 500,
            'message' => __('Thêm thất bại. Hãy kiểm tra lại.')
        ], 500);
    }
	
	
	/**
     * Sửa Contact_admin
     *
     * Sửa một Contact_admin
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * 
     * @pathParam admin_id BIGINT(20) required
     * Mã người quản lý
     * @pathParam fullname VARCHAR(191) required
     * Họ tên
     * @pathParam phone VARCHAR(191) required
     * Số điện thoại
     * @pathParam referral_code VARCHAR(191) required
     * Mã giới thiệu
     * @pathParam status INT(11) 
     * Trạng thái
     * 
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Sửa thành công."
     * }
	 * @response 500 {
     *      "status": 500,
     *      "message": "Sửa thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $response = $this->service->edit($request);
        if($response){
            return response()->json([
                'status' => 200,
                'message' => __('Sửa thành công.')
            ]);
        }
        return response()->json([
            'status' => 500,
            'message' => __('Sửa thất bại. Hãy kiểm tra lại.')
        ], 500);
    }
	
}