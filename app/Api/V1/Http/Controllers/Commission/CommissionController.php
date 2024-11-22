<?php

namespace App\Api\V1\Http\Controllers\Commission;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Commission\CommissionRequest;
use App\Api\V1\Http\Resources\Commission\{AllCommissionResource, ShowCommissionResource};
use App\Api\V1\Repositories\Commission\CommissionRepositoryInterface;
use App\Api\V1\Services\Commission\CommissionServiceInterface;
use App\Api\V1\Services\Commission\CommissionService;

/**
 * @group Hoa hồng
 */

class CommissionController extends Controller
{
    public function __construct(
        CommissionRepositoryInterface $repository,
        CommissionServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * DS Hoa hồng
     *
     * Lấy danh sách Commission.
     * 
     * @headerParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @queryParam page required The page number. Example: 1
     * 
     * @queryParam limit required The page number. Example: 10
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "article_id": "Thông tin của Article_id",
     *               "indirect_commission_default": "Thông tin của Indirect_commission_default",
     *               "direct_commission_default": "Thông tin của Direct_commission_default",
     *               "commission_detail_id": "Thông tin của Commission_detail_id"
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
    public function index(CommissionRequest $request)
    {
        try {
            $data = $request->validated();
            $commissions = $this->repository->paginate(...$data);
            $commissions = new AllCommissionResource($commissions);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $commissions
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
     * Chi tiết Hoa hồng
     *
     * Lấy chi tiết Commission
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
     *               "article_id": "Thông tin của Article_id",
     *               "indirect_commission_default": "Thông tin của Indirect_commission_default",
     *               "direct_commission_default": "Thông tin của Direct_commission_default",
     *               "commission_detail_id": "Thông tin của Commission_detail_id"
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
            $commission = $this->repository->findByID($id);
            $commission = new ShowCommissionResource($commission);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $commission
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
     * Xóa Commission
     *
     * Xóa Commission một Commission theo ID
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @queryParam id integer required
     * id Commission. Ví dụ: 1
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
     * Thêm Commission
     *
     * Thêm một Commission mới
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * 
     * @pathParam indirect_commission_default integer required
     * Hoa hồng gián tiếp
     * @pathParam direct_commission_default integer required
     * Hoa hồng trực tiếp
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
    public function add(CommissionRequest $request)
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
     * Sửa Commission
     *
     * Sửa một Commission
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @pathParam id integer required
     * id
     * @pathParam indirect_commission_default integer required
     * Hoa hồng gián tiếp
     * @pathParam direct_commission_default integer required
     * Hoa hồng trực tiếp
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
