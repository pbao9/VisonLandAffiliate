<?php

namespace App\Api\V1\Http\Controllers\Collaboration;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Collaboration\CollaborationRequest;
use App\Api\V1\Http\Resources\Collaboration\AllCollaborationResource;
use App\Api\V1\Http\Resources\Collaboration\CommissionResource;
use App\Api\V1\Http\Resources\Collaboration\DetailCollaborationResource;
use App\Api\V1\Repositories\Collaboration\CollaborationRepositoryInterface;
use App\Api\V1\Services\Collaboration\CollaborationServiceInterface;

/**
 * @group Tham gia / Hoa hồng
 */

class CollaborationController extends Controller
{
    public function __construct(
        CollaborationRepositoryInterface $repository,
        CollaborationServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * Hợp tác
     *
     * Hợp tác với quản lý
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * @authenticated
     *
     * @bodyParam article_id integer required Mã dự án. Example: 1
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
    public function add(CollaborationRequest $request)
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
     *
     * DS Hợp tác Dự án
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * @authenticated
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
    public function index(CollaborationRequest $request)
    {
        try {
            $data = $request->validated();
            $paginationData = $this->repository->paginate($data['page'], $data['limit'] ?? 10, $request->user()->id);
            $collab = new AllCollaborationResource($paginationData['data']);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $collab,
                'pagination' => [
                    'current_page' => $paginationData['currentPage'],
                    'total_pages' => $paginationData['totalPages'],
                    'has_prev' => $paginationData['hasPrev'],
                    'has_next' => $paginationData['hasNext'],
                ]
            ]);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.') . $e->getMessage()
            ]);
        }
    }

    /**
     *
     * Chi tiết thông tin hợp tác
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * @authenticated
     * @pathParam id integer required Mã hợp tác. Example: 1
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

    public function show($id)
    {
        try {
            $data = $this->repository->find($id);
            $collab = new DetailCollaborationResource($data);
            if ($data) {
                return response()->json([
                    'status' => 200,
                    'message' => __('Thực hiện thành công.'),
                    'data' => $collab,
                ]);
            }

            return response()->json([
                'status' => 404,
                'messagee' => __('Không tồn tại'),
            ], 404);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.') . $e->getMessage()
            ]);
        }
    }


    /**
     *
     * Thống kê tất cả dự án tham gia
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * @authenticated
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

    public function all()
    {
        try {
            $user_id = request()->user()->id;
            $info = $this->repository->getAllCommissionsByUser($user_id);

            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $info, // chỉ trả về kết quả tổng hợp
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.') . $e->getMessage()
            ]);
        }
    }
}
