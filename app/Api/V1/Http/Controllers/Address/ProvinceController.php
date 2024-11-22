<?php

namespace App\Api\V1\Http\Controllers\Address;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Address\ProvinceRequest;
use App\Api\V1\Http\Resources\Address\Province\AllProvinceResource;
use App\Api\V1\Repositories\Address\Province\ProvinceRepositoryInterface;
use \Illuminate\Http\Request;

/**
 * @group Tỉnh/ thành
 */

class ProvinceController extends Controller
{
    public function __construct(
        ProvinceRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    /**
     *
     * Danh sách tỉnh thành
     *
     * Lấy danh sách tỉnh thành.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @requestBody page integer
     * Trang hiện tại, page > 0. Example: 1
     * @body fullname string required Họ và tên của bạn. Example: Nguyen Van A
     *
     * @body limit integer
     * Số lượng bài viết trong 1 trang, limit > 0. Example: 10
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *               "id": 7,
     *               "name": "parent 3",
     *               "slug": "parent-3",
     *               "children": [
     *                   {
     *                       "id": 8,
     *                       "name": "child 3",
     *                       "slug": "child-3"
     *                   }
     *               ]
     *           }
     *      ]
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProvinceRequest $request)
    {
        $data = $request->validated();
        $paginationData = $this->repository->paginate($data['page'], $data['limit'] ?? 10);

        $provinces = new AllProvinceResource($paginationData['data']);

        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $provinces,
            'pagination' => [
                'current_page' => $paginationData['currentPage'],
                'total_pages' => $paginationData['totalPages'],
                'has_prev' => $paginationData['hasPrev'],
                'has_next' => $paginationData['hasNext'],
            ]
        ]);
    }
}
