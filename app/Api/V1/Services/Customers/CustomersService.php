<?php

namespace App\Api\V1\Services\Customers;

use App\Admin\Repositories\Admin\AdminRepositoryInterface;
use App\Api\V1\Repositories\Articles\ArticlesRepositoryInterface;
use App\Api\V1\Services\Customers\CustomersServiceInterface;
use App\Api\V1\Repositories\Customers\CustomersRepositoryInterface;
use App\Api\V1\Repositories\Notification\NotificationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Api\V1\Support\AuthSupport;
use App\Enums\Article\ArticleArticleStatus;
use App\Enums\Notification\NotificationEnum;
use App\Models\Customers;
use App\Models\Notification;

class CustomersService implements CustomersServiceInterface
{
    use AuthSupport;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    protected $articleRepository;
    protected $notificationRepository;


    public function __construct(
        CustomersRepositoryInterface $repository,
        ArticlesRepositoryInterface $articleRepository,
        NotificationRepositoryInterface $notificationRepository,
    ) {
        $this->repository = $repository;
        $this->articleRepository = $articleRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function add(Request $request)
    {
        $result = $request->validated();

        $user = $request->user()->id;
        $result['user_id'] = $user;
        return $this->repository->create($result);
    }

    public function contact(Request $request)
    {
        $result = $request->validated();
        $article = $this->articleRepository->find($result['article_id']);

        $statusArticle = $article->active_status;

        if ($statusArticle === ArticleArticleStatus::Approved) {
            if (!$article) {
                return [
                    'status' => 404,
                    'message' => __('Bài đăng này không còn hoặc không tồn tại!')
                ];
            }
            $userCheck = $article['user_id'];

            if (!$userCheck) {
                return [
                    'status' => 404,
                    'message' => __('Bài đăng này thuộc Admin không thể liên hệ')
                ];
            }

            $phoneCheck = $this->repository->checkPhone($article['id'], $result['phone']);
            if ($phoneCheck) {
                return [
                    'status' => 409,
                    'message' => __('Số điện thoại đã liên hệ! Vui lòng đợi phản hồi!')
                ];
            }


            $result['user_id'] = $article->user_id;

            $dataNotify = [
                'user_id' => $article->user_id ?? '',
                'article_id' => $article->id,
                'title' => 'Bạn có thông tin cần liên hệ lại!',
                'content' => 'Bạn có thông tin cần liên hệ lại! ' .
                    '<br/>Họ tên: ' .  $result['customer_name'] . '<br/>' . ' Số điện thoại: ' . $result['phone'] . '<br/>' . 'Nhu cầu: ' .  $result['needs'],
                'admin_id' => null,
                'status' => NotificationEnum::NotSeen
            ];

            $this->notificationRepository->create($dataNotify);
            $this->repository->create($result);
            return [
                'status' => 200,
                'message' => __('Đã gửi yêu cầu liên hệ thành công!')
            ];
        } else {
            return [
                'status' => 400,
                'message' => __('Bài đăng đang được chờ duyệt')
            ];
        }
    }

    public function edit(Request $request)
    {
        $requestData = $request->validated();
        $customer = $this->repository->find($requestData['id']);

        $user = $request->user()->id;
        $checkUSer = $this->repository->findUser($user);
        if ($checkUSer) {
            try {
                $customer->update($requestData);
                return [
                    'status' => 200,
                    'message' => __('Cập nhật khách hàng thành công!')
                ];
            } catch (\Exception $e) {
                return [
                    'status' => 500,
                    'message' => __('Đã có lỗi xảy ra') . $e->getMessage()
                ];
            }
        }

        return [
            'status' => 403,
            'message' => 'Khách hàng này không phải của bạn!'
        ];
    }
}
