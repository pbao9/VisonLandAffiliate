<?php

namespace App\Api\V1\Http\Controllers\Notification;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Notification\NotificationRequest;
use App\Api\V1\Http\Resources\Notification\{AllNotificationResource, ShowNotificationResource};
use App\Api\V1\Repositories\Notification\NotificationRepositoryInterface;
use App\Api\V1\Services\Notification\NotificationServiceInterface;
use App\Api\V1\Services\Notification\NotificationService;
use App\Enums\Notification\NotificationEnum;
use Illuminate\Support\Facades\Auth;

/**
 * @group Thông báo
 */

class NotificationController extends Controller
{
    public function __construct(
        NotificationRepositoryInterface $repository,
        NotificationServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * DS Thông báo
     *
     * Lấy danh sách Notification.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * @authenticated
     * @queryParam page required The page number. Example: 1
     *
     * @queryParam limit required The page number. Example: 10
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "user_id": "Thông tin của User_id",
     *               "title": "Thông tin của Title",
     *               "content": "Thông tin của Content",
     *               "admin_id": "Thông tin của Admin_id",
     *               "status": "Thông tin của Status"
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
    public function index(NotificationRequest $request)
    {
        try {
            $user = $request->user()->id;
            $data = $request->validated();
            $notifications = $this->repository->paginate($data['page'], $data['limit'] ?? 10, $user);
            $data = new AllNotificationResource($notifications['data']);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $data,
                'total' => $notifications['total'],
                'pagination' => [
                    'current_page' => $notifications['currentPage'],
                    'total_pages' => $notifications['totalPages'],
                    'has_prev' => $notifications['hasPrev'],
                    'has_next' => $notifications['hasNext'],
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
     * Chi tiết Thông báo
     *
     * Thực hiện xem chi tiết thông báo
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated
     * @pathParam id integer required
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "title": "Tiêu đề của thông báo",
     *               "content": "Nội dung của thông báo",
     *               "admin": "Thông tin của Admin"
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
    public function read($id)
    {
        try {
            $user = Auth::guard('api')->user()->id;
            $notification = $this->repository->findByID($id, $user);

            if (is_array($notification)) {
                return response()->json([
                    'status' => $notification['status'],
                    'message' => $notification['message'],
                ], $notification['status']);
            }
            $notification->update(['status' => NotificationEnum::Seen]);
            $notification = new ShowNotificationResource($notification);
            return response()->json([
                'status' => 200,
                'message' => __('Thành công'),
                'data' => $notification
            ], 200);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.') . $e->getMessage()
            ]);
        }
    }

    /**
     * Đọc tất cả thông báo
     *
     * API cho phép đọc tất cả thông báo
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Đã đánh dấu đọc tất cả thông báo"
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
    public function readAll()
    {
        $userId = auth()->user()->id;
        $notifications = $this->repository->getByUserId($userId, NotificationEnum::NotSeen);

        foreach ($notifications as $notification) {
            $notification->update(['status' => NotificationEnum::Seen]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Đã đánh dấu tất cả thông báo là đã đọc.',
        ]);
    }
}
