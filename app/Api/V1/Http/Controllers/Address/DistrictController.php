<?php

namespace App\Api\V1\Http\Controllers\Address;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Address\ProvinceRequest;
use App\Api\V1\Http\Resources\Address\District\AllDistrictResource;
use App\Api\V1\Repositories\Address\District\DistrictRepositoryInterface;
use \Illuminate\Http\Request;

/**
 * @group Quận / huyện
 */

class DistrictController extends Controller
{
    public function __construct(
        DistrictRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    /**
     * Danh sách quận huyện
     *
     * Lấy danh sách quận huyện
     *
     * @headersParam X-TOKEN-ACCESS string required
     * token để lấy dữ liệu. Example: 132323
     *
     * @queryParam page integer
     * Trang hiện tại, page > 0. Example: 1
     *
     * @queryParam limit integer
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

        $provinces = new AllDistrictResource($paginationData['data']);

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
