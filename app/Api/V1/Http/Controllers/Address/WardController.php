<?php

namespace App\Api\V1\Http\Controllers\Address;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Address\ProvinceRequest;
use App\Api\V1\Http\Requests\Address\WardRequest;
use App\Api\V1\Http\Resources\Address\District\AllDistrictResource;
use App\Api\V1\Http\Resources\Address\Ward\AllWardResource;
use App\Api\V1\Repositories\Address\District\DistrictRepositoryInterface;
use App\Api\V1\Repositories\Address\Ward\WardRepositoryInterface;
use \Illuminate\Http\Request;

/**
 * @group Phường/ Xã
 */

class WardController extends Controller
{
    public function __construct(
        WardRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    /**
     * Danh sách phường/ xã
     *
     * Lấy danh sách phường/ xã
     *
     * @headersParam X-TOKEN-ACCESS string required
     * token để lấy dữ liệu. Example: 132323
     *
     * @authentication
     *
     * @queryParam page integer
     * Trang hiện tại, page > 0. Example: 1
     *
     * @queryParam limit integer
     * Số lượng bài viết trong 1 trang, limit > 0. Example: 1
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
    public function index(WardRequest $request)
    {
        $data = $request->validated();
        $paginationData = $this->repository->paginate($data['page'], $data['limit'] ?? 10);

        $ward = new AllWardResource($paginationData['data']);

        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $ward,
            'pagination' => [
                'current_page' => $paginationData['currentPage'],
                'total_pages' => $paginationData['totalPages'],
                'has_prev' => $paginationData['hasPrev'],
                'has_next' => $paginationData['hasNext'],
            ]
        ]);
    }
}
