<?php

namespace App\Api\V1\Http\Controllers\Area;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Area\AreaRequest;
use App\Api\V1\Http\Resources\Area\{AllAreaResource, ShowAreaResource};
use App\Api\V1\Repositories\Area\AreaRepositoryInterface;

/**
 * @group Khu vực
 */

class AreaController extends Controller
{
    public function __construct(
        AreaRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }
    /**
     * DS khu vực bài đăng
     *
     * Lấy danh sách Area.
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "name": "Tên khu vực bài đăng",
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
    public function index(AreaRequest $request)
    {
        try {
            $data = $request->validated();
            $area = $this->repository->paginate(...$data);
            $area = new AllAreaResource($area);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $area
            ]);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ]);
        }
    }
}
