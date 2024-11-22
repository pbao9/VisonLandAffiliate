<?php

namespace App\Api\V1\Http\Controllers\CustomerRegistrations;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\CustomerRegistrations\CustomerRegistrationsRequest;
use App\Api\V1\Http\Resources\CustomerRegistrations\{AllCustomerRegistrationsResource, ShowCustomerRegistrationsResource};
use App\Api\V1\Repositories\CustomerRegistrations\CustomerRegistrationsRepositoryInterface;
use App\Api\V1\Services\CustomerRegistrations\CustomerRegistrationsServiceInterface;
use App\Api\V1\Services\CustomerRegistrations\CustomerRegistrationsService;

/**
 * @group Quản lý đăng ký khách hàng
 */

class CustomerRegistrationsController extends Controller
{
    public function __construct(
        CustomerRegistrationsRepositoryInterface $repository,
        CustomerRegistrationsServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Chi tiết Quản lý đăng ký khách hàng
     *
     * Lấy chi tiết CustomerRegistrations
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
     *               "customer_id": "Thông tin của Customer_id",
     *               "article_id": "Thông tin của Article_id",
     *               "status": "Thông tin của Status",
     *               "registration_day": "Thông tin của Registration_day",
     *               "approval_day": "Thông tin của Approval_day"
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
    public function show($id)
    {
        try {
            $customerRegistrations = $this->repository->findByID($id);
            $customerRegistrations = new ShowCustomerRegistrationsResource($customerRegistrations);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $customerRegistrations
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
     * Xóa CustomerRegistrations
     *
     * Xóa CustomerRegistrations một CustomerRegistrations theo ID
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * id CustomerRegistrations. Ví dụ: 1
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
    public function delete(Request $request)
    {

        $id = $request->input('id');
        $response = $this->repository->delete($id);

        if ($response) {
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
     * Đăng ký bài đăng không có token
     *
     * Đăng ký bài đăng có token & khách vãng lai
     *
     * @bodyParam article_id integer required Mã bài đăng. Example: 1
     * @bodyParam fullname string required Họ và tên của bạn. Example: Nguyen Van A
     * @bodyParam phone string required Số điện thoại. Example: 0909999999
     * @bodyParam needs string required Nhu cầu. Example: Tôi muốn mua căn hộ này với giá hữu nghị
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thêm thành công."
     * }
     *
     * @response 404 {
     *      "status": 401,
     *      "message": "Bài đăng không tồn tại"
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
    public function add(CustomerRegistrationsRequest $request)
    {
        $response = $this->service->add($request);
        if ($response) {
            return response()->json([
                'status' => $response['status'],
                'message' => $response['message']
            ], $response['status']);
        }
        return response()->json([
            'status' => 500,
            'message' => __('Thêm thất bại. Hãy kiểm tra lại.')
        ], 500);
    }


    /**
     * Đăng ký bài đăng có token
     *
     * Đăng ký bài đăng có token
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated
     *
     * @bodyParam article_id integer required Mã bài đăng. Example: 1
     * @bodyParam fullname string required Họ và tên của bạn. Example: Nguyen Van B
     * @bodyParam phone string required Số điện thoại. Example: 0909993339
     * @bodyParam needs string required Nhu cầu. Example: Tôi muốn mua căn hộ này với giá sinh viên
     * @bodyParam referal_code string Mã giới thiệu. Example: U080D51730690774
     *
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Đã đăng ký đến admin thành công"
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
    public function addHasToken(CustomerRegistrationsRequest $request)
    {
        $response = $this->service->addHasToken($request);
        if ($response) {
            return response()->json([
                'status' => $response['status'],
                'message' => $response['message']
            ], $response['status']);
        }
        return response()->json([
            'status' => 500,
            'message' => __('Thêm thất bại. Hãy kiểm tra lại.')
        ], 500);
    }


    /**
     * Sửa CustomerRegistrations
     *
     * Sửa một CustomerRegistrations
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     *
     * @pathParam customer_id BIGINT(20) required
     * Mã khách hàng
     * @pathParam article_id BIGINT(20) required
     * Mã bài đăng
     * @pathParam status INT(11) required
     * Trạng thái
     * @pathParam registration_day DATETIME required
     * Ngày đăng ký
     * @pathParam approval_day DATETIME required
     * Ngày phê duyệt
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
        if ($response) {
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

    /**
     * Danh sách bài đăng đã tham gia
     *
     * Danh sách bài đăng đã tham gia
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * @authenticated
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "customer_id": "Thông tin của Customer_id",
     *               "article_id": "Thông tin của Article_id",
     *               "status": "Thông tin của Status",
     *               "registration_day": "Thông tin của Registration_day",
     *               "approval_day": "Thông tin của Approval_day"
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
    public function list()
    {
        try {
            $user = auth()->user()->id;
            $data = $this->repository->getUserJoin($user)->load('articles');
            $customerRegistrations = new AllCustomerRegistrationsResource($data);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $customerRegistrations
            ]);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.') . $e->getMessage()
            ]);
        }
    }
}
