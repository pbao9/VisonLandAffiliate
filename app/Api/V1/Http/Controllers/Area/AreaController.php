<?php

namespace App\Api\V1\Http\Controllers\Area;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Area\AreaRequest;
use App\Api\V1\Http\Resources\Area\{AllAreaResource, ShowAreaResource};
use App\Api\V1\Repositories\Area\AreaRepositoryInterface;


/*
 * @OA\Tag(
 *     name="Area",
 *     description="API Endpoints for managing districts"
 * )
 */

class AreaController extends Controller
{
    public function __construct(
        AreaRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }
    /**
     * Danh sách phường xã
     *
     * Lấy Danh sách khu vực
     *
     * @OA\Get(
     *     path="/api/v1/areas",
     *     tags={"Area"},
     *     summary="Lấy Danh sách khu vực",
     *     description="Lấy Danh sách khu vực với phân trang.",
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
