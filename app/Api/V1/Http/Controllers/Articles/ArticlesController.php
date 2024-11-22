<?php

namespace App\Api\V1\Http\Controllers\Articles;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Articles\ArticlePaymentRequest;
use App\Api\V1\Http\Requests\Articles\ArticleSearchRequest;
use App\Api\V1\Http\Resources\Articles\StatusArticle;
use App\Api\V1\Http\Resources\Articles\TypeArticle;
use Illuminate\Http\Request;
use App\Api\V1\Http\Requests\Articles\ArticlesRequest;
use App\Api\V1\Http\Resources\Articles\{AllArticlesResource, ShowArticlesResource};
use App\Api\V1\Repositories\Articles\ArticlesRepositoryInterface;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Services\Articles\ArticlesServiceInterface;
use App\Enums\User\UserIdentifier;
use App\Models\Articles;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * @group Bài đăng
 */

class ArticlesController extends Controller
{
    protected $userRepository;
    public function __construct(
        ArticlesRepositoryInterface $repository,
        ArticlesServiceInterface $service,
        UserRepositoryInterface $userRepository
    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->userRepository = $userRepository;
    }
    /**
     * DS Bài đăng
     *
     * Lấy danh sách bài đăng.
     *
     * Trong đó:
     *
     * <strong>owner</strong>: Chủ bài đăng thuộc
     * <br/>
     * <strong>type</strong>: Loại bài đăng
     * <ul>
     *     <li>1: Bán</li>
     *     <li>2: Cho thuê</li>
     * </ul>
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
     *         {
     *               "id": 4,
     *              "owner": {
     *                  "fullname": "Phạm Bảo",
     *                  "avatar": "http://example.com/path/to/1730018711_avatar_ad6a33b5-b01e-41d7-beb6-0ea1c0529fcd.jpeg"
     *                   },
     *               "code": "UF68751730018835",
     *               "type": "1",
     *               "title": "Thông tin của Title",
     *               "slug": "Thông tin của Slug",
     *               "description": "Thông tin của Description",
     *               "area": "Thông tin của Area",
     *               "price": "Thông tin của Price",
     *               "price_consent": "Thông tin của Price_consent",
     *               "quantity": "Thông tin của Quantity",
     *               "height_floor": "Thông tin của Height_floor",
     *               "project_size": "Thông tin của Project_size",
     *               "investor": "Thông tin của Investor",
     *               "constructor": "Thông tin của Constructor",
     *               "hand_over": "Thông tin của Hand_over",
     *               "deployment_time": "Thông tin của Deployment_time",
     *               "building_density": "Mật độ",
     *               "utilities": "Thông tin tiện ích",
     *               "active_status": "Trạng thái hoạt động",
     *               "image": [
     *                   "http://example.com/path/to/1730018711_avatar_ad6a33b5-b01e-41d7-beb6-0ea1c0529fcd.jpeg",
     *                   "http://example.com/path/to/1730018711_avatar_ad6a33b5-b01e-41d7-beb6-0ea1c0529fcd.jpeg"
     *               ],
     *               "name_contact": "Thông tin của Người liên hệ",
     *               "phone_contact": "Thông tin của SDT liên hệ",
     *               "status": "Thông tin của trạng thái",
     *               "active_days": "Thông tin của ngày đăng",
     *               "time_start": "Thông tin của thời gian thi công",
     *               "district": "Thông tin của Quận/Huyện",
     *               "ward": "Thông tin của Phường/Xã",
     *               "province": "Thông tin của Tỉnh/Thành phố",
     *               "location": "Thông tin của Khu vực",
     *               "house_type": "Thông tin của Loại nhà"
     *          }
     *      ]
     * }
     * @response 404 {
     *      "status": 404,
     *      "message": "Đường dẫn hoặc bài đăng không tồn tại"
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
    public function index(ArticlesRequest $request)
    {
        try {
            $data = $request->validated();
            $paginationData = $this->repository->paginate($data['page'] ?? 1, $data['limit'] ?? 10);

            $articles = new AllArticlesResource($paginationData['data']);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $articles,
                'pagination' => [
                    'current_page' => $paginationData['currentPage'],
                    'total_pages' => $paginationData['totalPages'],
                    'has_prev' => $paginationData['hasPrev'],
                    'has_next' => $paginationData['hasNext'],
                ]
            ]);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ]);
        }
    }

    /**
     * Chi tiết Bài đăng
     *
     * Lấy chi tiết bài đăng
     *
     * @pathParam id integer required Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *         {
     *               "id": 4,
     *              "owner": {
     *                  "fullname": "Phạm Bảo",
     *                  "avatar": "http://example.com/path/to/1730018711_avatar_ad6a33b5-b01e-41d7-beb6-0ea1c0529fcd.jpeg"
     *                   },
     *               "code": "UF68751730018835",
     *               "type": "1",
     *               "title": "Thông tin của Title",
     *               "slug": "Thông tin của Slug",
     *               "description": "Thông tin của Description",
     *               "area": "Thông tin của Area",
     *               "price": "Thông tin của Price",
     *               "price_consent": "Thông tin của Price_consent",
     *               "quantity": "Thông tin của Quantity",
     *               "height_floor": "Thông tin của Height_floor",
     *               "project_size": "Thông tin của Project_size",
     *               "investor": "Thông tin của Investor",
     *               "constructor": "Thông tin của Constructor",
     *               "hand_over": "Thông tin của Hand_over",
     *               "deployment_time": "Thông tin của Deployment_time",
     *               "building_density": "Mật độ",
     *               "utilities": "Thông tin tiện ích",
     *               "active_status": "Trạng thái hoạt động",
     *               "image": [
     *                   "http://example.com/path/to/1730018711_avatar_ad6a33b5-b01e-41d7-beb6-0ea1c0529fcd.jpeg",
     *                   "http://example.com/path/to/1730018711_avatar_ad6a33b5-b01e-41d7-beb6-0ea1c0529fcd.jpeg"
     *               ],
     *               "name_contact": "Thông tin của Người liên hệ",
     *               "phone_contact": "Thông tin của SDT liên hệ",
     *               "status": "Thông tin của trạng thái",
     *               "active_days": "Thông tin của ngày đăng",
     *               "time_start": "Thông tin của thời gian thi công",
     *               "district": "Thông tin của Quận/Huyện",
     *               "ward": "Thông tin của Phường/Xã",
     *               "province": "Thông tin của Tỉnh/Thành phố",
     *               "location": "Thông tin của Khu vực",
     *               "house_type": "Thông tin của Loại nhà"
     *          }
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
    public function show($id)
    {
        try {
            $articles = $this->repository->find($id);
            $data = new ShowArticlesResource($articles);
            if ($articles) {
                return response()->json([
                    'status' => 200,
                    'message' => __('Thực hiện thành công.'),
                    'data' => $data
                ], 200);
            }
            return response()->json([
                'status' => 404,
                'message' => __('Bài đăng không tồn tại!'),
            ], 404);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu cần thiết
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.')
            ], 500);
        }
    }

    /**
     * Thêm Bài đăng
     *
     * Thêm một Bài đăng mới
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * @authenticated
     * @bodyParam type integer required. Example: 1
     * Loại
     * @bodyParam description string nullable. Example: Mô tả
     * Mô tả
     * @bodyParam title string required. Example: Bài đăng
     * Tiêu đề
     * @bodyParam area string required. Example: 10 x 20
     * Diện tích
     * @bodyParam price integer required. Example: 100000000
     * Giá tiền
     * @bodyParam quantity integer required. Example: 10
     * Số lượng
     * @bodyParam image string required. Example: ["\/public\/uploads\/images\/432194907_452390130474852_6564337089524604919_n.jpg","\/public\/uploads\/images\/logomevivumoi.png"]
     * Hình ảnh
     * @bodyParam phone_contact string required. Example: 0123456789
     * Số điện thoại liên hệ
     * @bodyParam status integer required. Example: 1
     * Trạng thái
     * @bodyParam district_id integer required. Example: 250
     * Quận
     * @bodyParam ward_id integer required. Example: 9077
     * Phường
     * @bodyParam province_id integer required. Example: 1
     * Tỉnh
     * @bodyParam area_id integer required. Example: 1
     * Khu vực bài đăng
     * @bodyParam houseType_id string required. Example: ["1", "2"]
     * Loại hình nhà
     * @bodyParam article_status integer required. Example: 1
     * Trạng thái bài đăng
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thêm thành công."
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thêm thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function add(ArticlesRequest $request)
    {
        $response = $this->service->add($request);
        return response()->json([
            'status' => $response['status'],
            'message' => $response['message']
        ], $response['status']);
    }


    /**
     * Sửa Bài đăng
     *
     * Sửa một Bài đăng
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id BIGINT(20) required. Example: 1
     * Id
     * @pathParam user_id BIGINT(20) required. Example: 1
     * Mã người dùng
     * @pathParam admin_id BIGINT(20) nullable. Example:
     * Mã quản lý
     * @pathParam code VARCHAR(191) nullable. Example:
     * Code
     * @pathParam type INT(11) required. Example: 1
     * Loại
     * @pathParam title VARCHAR(191) required. Example: Bài đăng
     * Tiêu đề
     * @pathParam description LONGTEXT nullable. Example: Mô tả
     * Mô tả
     * @pathParam article_status INT(11) required. Example: 1
     * Trạng thái bài đăng
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Sửa thành công."
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
    public function edit(ArticlesRequest $request)
    {
        $response = $this->service->edit($request);
        return response()->json([
            'status' => $response['status'],
            'message' => $response['message']
        ], $response['status']);
    }

    /**
     * Thanh toán bài đăng
     *
     * Thanh toán bài đăng
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam article_id BIGINT(20) required. Example: 1
     * Mã người dùng
     * @bodyParam document TEXT required. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thêm thành công."
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thêm thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function payment(ArticlePaymentRequest $request)
    {

        $response = $this->service->payment($request);
        if (is_array($response) && isset($response['status'])) {
            return response()->json([
                'status' => $response['status'],
                'message' => $response['message']
            ], $response['status']);
        }

        return response()->json([
            'status' => 500,
            'message' => __('Có lỗi xảy ra trong quá trình xử lý.')
        ], 500);
    }

    /**
     * Tìm kiếm bài đăng
     *
     * Tìm kiếm bài đăng
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam article_id BIGINT(20) required. Example: 1
     * Mã người dùng
     * @bodyParam document TEXT required. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thêm thành công."
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thêm thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(ArticleSearchRequest $request)
    {
        try {
            $criteria = $request->validated();

            $articles = $this->repository->findAndSearchWithRelation(null, $criteria, $criteria['page'], $criteria['limit'] ?? 10);
            $articlesResource = new AllArticlesResource($articles['data']);

            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $articlesResource,
                'pagination' => [
                    'current_page' => $articles['currentPage'],
                    'total_pages' => $articles['totalPages'],
                    'has_prev' => $articles['hasPrev'],
                    'has_next' => $articles['hasNext'],
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.'),
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Xóa bài đăng
     *
     * Xóa bài đăng
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id BIGINT(20) required. Example: 1
     * id của bài đăng được user đó đăng, trường hợp ngoại lệ sẽ không có xóa được!
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Xóa thành công."
     * }
     * @response 403 {
     *      "status": 403,
     *      "message": "Bạn không có quyền xóa bài viết này."
     * }
     * @response 404 {
     *      "status": 404,
     *      "message": "Bài viết không tồn tại"
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Xóa thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $response = $this->service->delete($request);

        return response()->json([
            'status' => $response['status'],
            'message' => $response['message']
        ], $response['status']);
    }


    /**
     * Tìm kiếm bài đăng
     *
     * Tìm kiếm bài đăng
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam article_id BIGINT(20) required. Example: 1
     * Mã người dùng
     * @bodyParam document TEXT required. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thêm thành công."
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thêm thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function searchMyArticle(ArticleSearchRequest $request)
    {
        try {
            $criteria = $request->validated();
            $user = $request->user()->id;
            $articles = $this->repository->findAndSearchForUser(null, $criteria, $criteria['page'], $criteria['limit'] ?? 10, $user);
            $articlesResource = new AllArticlesResource($articles['data']);

            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $articlesResource,
                'pagination' => [
                    'current_page' => $articles['currentPage'],
                    'total_pages' => $articles['totalPages'],
                    'has_prev' => $articles['hasPrev'],
                    'has_next' => $articles['hasNext'],
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => __('Thực hiện thất bại.'),
                'error' => $e->getMessage()
            ]);
        }
    }


    /**
     * Trang thái Dự án
     *
     * Trạng thái dự án
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thêm thành công."
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thêm thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */

    public function statusArticle()
    {
        $data = new StatusArticle([]);
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }


    /**
     * Loại dự án
     *
     * Loại dự án
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thêm thành công."
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thêm thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */

    public function typeArticle()
    {
        $data = new TypeArticle([]);
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    /**
     * Giới thiệu dự án
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Ví dụ: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     * 
     * @pathParam article_id integer required Mã bài đăng. Example: 1
     * @pathParam referal_code string required Mã giới thiệu. Example: U4FCE51730867636
     * 
     * @response 200 {
     *      "status": 200,
     *      "message": "Thêm thành công."
     * }
     * @response 500 {
     *      "status": 500,
     *      "message": "Thêm thất bại. Hãy kiểm tra lại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */

    public function viewArticle($article_id, $code)
    {
        $article = $this->repository->find($article_id);
        if (!$article) {
            return response()->json([
                'status' => 404,
                'message' => 'Dự án không tồn tại'
            ], 404);
        }

        $user = $this->userRepository->findByColumn('code', $code);
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Không tồn tại mã code'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Thông tin bao gồm mã dự án & mã giới thiệu người dùng',
            'data' => [
                'article_id' => $article->id,
                'article_title' => $article->title,
                'referral_code' => $user->code,
                'referrer_name' => $user->fullname,
            ]
        ]);
    }
}
