<?php

namespace App\Api\V1\Http\Controllers\Commission;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\CommissionDetail\CommissionDetailRequest;
use App\Api\V1\Http\Resources\CommissionDetail\AllCommissionDetailResource;
use App\Api\V1\Http\Resources\CommissionDetail\ShowCommissionDetailResource;
use App\Api\V1\Repositories\CommissionDetail\CommissionDetailRepositoryInterface;
use App\Api\V1\Services\CommissionDetail\CommissionDetailServiceInterface;
use App\Api\V1\Services\CommissionDetail\CommissionDetailService;

/**
 * @group Hoa hồng chi tiết
 */

class CommissionDetailController extends Controller
{
    public function __construct(
        CommissionDetailRepositoryInterface $repository,
        CommissionDetailServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * DS Hoa hồng chi tiết
     *
     * Lấy danh sách Commission_detail.
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
     *               "commission_id": "Thông tin của Commission_id",
     *               "total_amount": "Thông tin của Total_amount",
     *               "amount_paid": "Thông tin của Amount_paid",
     *               "amount_percent": "Thông tin của Amount_percent"
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
    public function index(CommissionDetailRequest $request)
    {
        try {
            $data = $request->validated();
            $commission_details = $this->repository->paginate(...$data);
            $commission_details = new AllCommissionDetailResource($commission_details);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $commission_details
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
     * Chi tiết Hoa hồng chi tiết
     *
     * Lấy chi tiết Commission_detail
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
     *               "commission_id": "Thông tin của Commission_id",
     *               "total_amount": "Thông tin của Total_amount",
     *               "amount_paid": "Thông tin của Amount_paid",
     *               "amount_percent": "Thông tin của Amount_percent"
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
            $commission_detail = $this->repository->findByID($id);
            $commission_detail = new ShowCommissionDetailResource($commission_detail);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $commission_detail
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
     * Xóa Commission_detail
     *
     * Xóa Commission_detail một Commission_detail theo ID
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @pathParam id integer required
     * id Commission_detail. Ví dụ: 1
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
     * Thêm Commission_detail
     *
     * Thêm một Commission_detail mới
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @pathParam commission_id BIGINT(20) required
     * Mã hoa hồng
     * @pathParam total_amount BIGINT(20) required
     * Tổng cộng
     * @pathParam amount_paid BIGINT(20) required
     * Số tiền đã trả
     * @pathParam amount_percent BIGINT(20) required
     * Phần trăm
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
    // public function add(Commission_detailRequest $request)
    // {
    //     $response = $this->service->add($request);
    //     if($response){
    //         return response()->json([
    //             'status' => 200,
    //             'message' => __('Thêm thành công.')
    //         ]);
    //     }
    //     return response()->json([
    //         'status' => 500,
    //         'message' => __('Thêm thất bại. Hãy kiểm tra lại.')
    //     ], 500);
    // }


    /**
     * Sửa Commission_detail
     *
     * Sửa một Commission_detail
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * 
     * @pathParam commission_id BIGINT(20) required
     * Mã hoa hồng
     * @pathParam total_amount BIGINT(20) required
     * Tổng cộng
     * @pathParam amount_paid BIGINT(20) required
     * Số tiền đã trả
     * @pathParam amount_percent BIGINT(20) required
     * Phần trăm
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
}
