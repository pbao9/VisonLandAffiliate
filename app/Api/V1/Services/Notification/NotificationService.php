<?php

namespace App\Api\V1\Services\Notification;

use App\Api\V1\Services\Notification\NotificationServiceInterface;
use App\Api\V1\Repositories\Notification\NotificationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Api\V1\Support\AuthSupport;
use App\Models\Notification;

class NotificationService implements NotificationServiceInterface
{
    use AuthSupport;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(
        NotificationRepositoryInterface $repository,
    ){
        $this->repository = $repository;
    }
    
    public function add(Request $request){
        // Validate request data
        $validatedData = $request->validate([
            'user_id' => 'required',
            'title' => 'nullable',
            'content' => 'required',
            'admin_id' => 'required',
            'status' => 'nullable',
            
            // Thêm các quy tắc validation khác nếu cần
        ]);

        // Tạo một bản ghi mới dựa trên dữ liệu từ request
        $newRecord = Notification::create($validatedData);

        // Trả về thông tin về bản ghi mới đã được tạo
        return 1;
    }

	public function edit(Request $request){
        // Lấy dữ liệu từ request
		$requestData = $request->all();

		try {
			// Lấy ID của bản ghi cần cập nhật từ request hoặc từ các tham số khác
			$id = $requestData['id']; // Giả sử bạn gửi ID từ request
			
			// Tìm bản ghi cần cập nhật từ cơ sở dữ liệu
			$record = Notification::findOrFail($id);

			// Cập nhật các trường dữ liệu của bản ghi từ request
			$record->update($requestData);

			// Trả về thông báo thành công hoặc dữ liệu đã cập nhật
			return 1;
		} catch (\Exception $e) {
			// Xử lý ngoại lệ nếu cần thiết
			return 0;
		}
    }
}