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

use OpenApi\Annotations as OA;


/*
 * @OA\Tag(
 *     name="Address",
 *     description="API truy vấn quận huyện/tỉnh thành"
 * )
 */


class WardController extends Controller
{
    public function __construct(
        WardRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    /**
     * Danh sách phường xã
     *
     * Lấy danh sách phường xã
     *
     * @OA\Get(
     *     path="/api/v1/address/ward",
     *     tags={"Ward"},
     *     summary="Lấy danh sách phường xã",
     *     description="Lấy danh sách phường xã với phân trang.",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Trang hiện tại, page > 0.",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Số lượng bài viết trong 1 trang, limit > 0.",
     *         required=false,
     *         @OA\Schema(type="integer", example=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Thành công",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Thực hiện thành công."),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=7),
     *                     @OA\Property(property="name", type="string", example="parent 3"),
     *                     @OA\Property(property="slug", type="string", example="parent-3"),
     *                     @OA\Property(
     *                         property="children",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(property="id", type="integer", example=8),
     *                             @OA\Property(property="name", type="string", example="child 3"),
     *                             @OA\Property(property="slug", type="string", example="child-3")
     *                         )
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="pagination",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="total_pages", type="integer", example=5),
     *                 @OA\Property(property="has_prev", type="boolean", example=false),
     *                 @OA\Property(property="has_next", type="boolean", example=true)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer", example=400),
     *             @OA\Property(property="message", type="string", example="Yêu cầu không hợp lệ.")
     *         )
     *     )
     * )
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
