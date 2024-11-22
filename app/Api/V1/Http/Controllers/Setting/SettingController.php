<?php

namespace App\Api\V1\Http\Controllers\Setting;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Setting\SettingRequest;
use App\Api\V1\Http\Resources\Setting\{AllSettingResource};
use App\Api\V1\Repositories\Setting\SettingRepositoryInterface;

/**
 * @group Thông tin chung
 */
class SettingController extends Controller
{
    public function __construct(
        SettingRepositoryInterface $repository,
    )
    {
        $this->repository = $repository;
    }
    /**
     * DS Quản lý thông tin chung
     *
     * Lấy danh sách Setting.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @queryParam page integer
     * Trang hiện tại, page > 0. Ví dụ: 1
     *
     * @queryParam limit integer
     * Số lượng Setting trong 1 trang, limit > 0. Ví dụ: 1
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *               "setting_key": "Thông tin của setting_key",
     *               "setting_name": "Thông tin của setting_name",
     *               "plain_value": "Thông tin của plain_value",
     *               "type_input": "Thông tin của type_input",
     *               "type_data": "Thông tin của type_data",
     *               "group": "Thông tin của group"
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
    public function index(SettingRequest $request){
		try {
			$data = $request->validated();
			$setting = $this->repository->paginate(...$data);
            $setting = new AllSettingResource($setting);
			return response()->json([
				'status' => 200,
				'message' => __('Thực hiện thành công.'),
				'data' => $setting
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
