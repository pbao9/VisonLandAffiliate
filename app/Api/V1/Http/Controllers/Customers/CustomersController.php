<?php

namespace App\Api\V1\Http\Controllers\Customers;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Customers\CustomersRequest;
use App\Api\V1\Http\Resources\Customers\{AllCustomersResource, ShowCustomersResource};
use App\Api\V1\Repositories\Customers\CustomersRepositoryInterface;
use App\Api\V1\Services\Customers\CustomersServiceInterface;
use App\Api\V1\Services\Customers\CustomersService;

/**
 * @group Khách hàng của Thành viên
 */

class CustomersController extends Controller
{
    public function __construct(
        CustomersRepositoryInterface $repository,
        CustomersServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * DS Khách hàng Thành viên
     *
     * Lấy danh sách Khách hàng của thành viên.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated
     *
     * @queryParam page required The page number. Example: 1
     *
     * @queryParam limit required The page number. Example: 10
     * @queryParam status Trạng thái của khách hàng. Example: 1
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "name": "Nguyễn Văn A",
     *               "phone": "0909999991",
     *               "needs": "Mua nhà",
     *               "status": "Đã thực hiện cuộc gọi"
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
    public function index(CustomersRequest $request)
    {
        try {
            $data = $request->validated();
            $user = $request->user()->id;

            $customersData = $this->repository->paginate($data['page'], $data['limit'] ?? 10, $data['status'], $user);

            $customers = new AllCustomersResource($customersData['data']);

            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $customers,
                'pagination' => [
                    'current_page' => $customersData['currentPage'],
                    'total_pages' => $customersData['totalPages'],
                    'has_prev' => $customersData['hasPrev'],
                    'has_next' => $customersData['hasNext'],
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.') . $e->getMessage()
            ]);
        }
    }

    /**
     * Chi tiết Bảng khách hàng
     *
     * Lấy chi tiết khách hàng
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated
     *
     * @pathParam id integer required Mã khách hàng. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "name": "Nguyễn Văn A",
     *               "phone": "0909999991",
     *               "needs": "Mua nhà",
     *               "status": "Đã thực hiện cuộc gọi"
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
            $customers = $this->repository->findByID($id);
            $data = new ShowCustomersResource($customers);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $data
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
     * Xóa Khách hàng
     *
     * Xóa Khách hàng theo ID
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * id Customers. Ví dụ: 1
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
     * Thêm Khách hàng
     *
     * Thêm một khách hàng mới
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * @authenticated
     *
     * @bodyParam customer_name string required Họ tên khách hàng. Example: Nguyễn văn a
     * @bodyParam phone string required Số điện thoại. Example: 0904449999
     * @bodyParam needs string required Nhu cầu. Example: Tôi muốn mua căn nhà ở mặt tiền hà nội chỉ với 1Jack
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
    public function add(CustomersRequest $request)
    {
        $response = $this->service->add($request);
        if ($response) {
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
     * Sửa thông tin khách hàng
     *
     * Sửa một thông tin khách hàng
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * @authenticated
     * @bodyParam id integer required Mã khách hàng. Example: 1
     * @bodyParam customer_name string required Tên khách hàng. Example: Nguyễn Văn A
     * @bodyParam phone string required Số Điện thoại. Example: 0903333333
     * @bodyParam needs string Nhu cầu. Example: Khách đã hết có nhu cầu mua nhà chuyển sang mua oto
     * @bodyParam status integer Trạng thái. Example: 1
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
    public function edit(CustomersRequest $request)
    {
        try {
            $response = $this->service->edit($request);
            return response()->json([
                'status' => $response['status'],
                'message' => $response['message']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Sửa thất bại. Hãy kiểm tra lại. ') . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Gửi liên hệ
     *
     * Gửi liên hệ cho môi giới/bán hàng
     *
     * @bodyParam article_id integer required Mã bài đăng. Example: 1
     * @bodyParam customer_name string required Tên khách hàng. Example: Nguyễn Văn A
     * @bodyParam phone string required Số điện thoại. Example: 0903336661
     * @bodyParam needs string required Nhu cầu. Example: Tôi muốn mua một căn nhà ở mặt tiền Bình Long
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
    public function contact(CustomersRequest $request)
    {
        $response = $this->service->contact($request);
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
}
