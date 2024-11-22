<?php

namespace App\Api\V1\Http\Controllers\HouseType;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\HouseType\HouseTypeRequest;
use App\Api\V1\Http\Resources\HouseType\{AllHouseTypeResource, ShowHouseTypeResource};
use App\Api\V1\Repositories\HouseType\HouseTypeRepositoryInterface;

/**
 * @group Loại hình nhà
 */

class HouseTypeController extends Controller
{
    public function __construct(
        HouseTypeRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }
    /**
     * DS loại hình nhà
     *
     * Lấy danh sách loại hình nhà.
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "name": "Tên loại hình nhà",
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
    public function index(HouseTypeRequest $request)
    {
        try {
            $data = $request->validated();
            $houseTypes = $this->repository->paginate(...$data);
            $houseTypes = new AllHouseTypeResource($houseTypes);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $houseTypes
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
