<?php

namespace App\Api\V1\Http\Controllers\Address;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Address\ProvinceRequest;
use App\Api\V1\Http\Resources\Address\Province\AllProvinceResource;
use App\Api\V1\Repositories\Address\Province\ProvinceRepositoryInterface;
use \Illuminate\Http\Request;

use OpenApi\Annotations as OA;


/*
 * @OA\Tag(
 *     name="Address",
 *     description="API truy vấn quận huyện/tỉnh thành"
 * )
 */

class ProvinceController extends Controller
{
    public function __construct(
        ProvinceRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }

    /**
     * Danh sách tỉnh thành
     *
     * Lấy danh sách tỉnh thành
     *
     * @OA\Get(
     *     path="/api/v1/address/province",
     *     tags={"Province"},
     *     summary="Lấy danh sách tỉnh thành",
     *     description="Lấy danh sách tỉnh thành với phân trang.",
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
