<?php

namespace App\Api\V1\Services\CustomerRegistrations;

use App\Api\V1\Repositories\Articles\ArticlesRepositoryInterface;
use App\Api\V1\Services\CustomerRegistrations\CustomerRegistrationsServiceInterface;
use App\Api\V1\Repositories\CustomerRegistrations\CustomerRegistrationsRepositoryInterface;
use App\Enums\CustomerRegistration\CustomerRegistrationStatus;
use App\Enums\CustomerRegistration\CustomerRegistrationType;
use App\Enums\Notification\NotificationEnum;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Api\V1\Support\AuthSupport;
use App\Models\CustomerRegistrations;

class CustomerRegistrationsService implements CustomerRegistrationsServiceInterface
{
    use AuthSupport;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    protected $articlesRepository;

    public function __construct(
        CustomerRegistrationsRepositoryInterface $repository,
        ArticlesRepositoryInterface $articlesRepository
    ) {
        $this->repository = $repository;
        $this->articlesRepository = $articlesRepository;
    }

    public function add(Request $request)
    {
        return $this->processRegistration($request);
    }

    public function addHasToken(Request $request)
    {
        return $this->processRegistration($request, true);
    }

    protected function processRegistration(Request $request, $hasToken = false)
    {
        $data = $request->validated();
        $data['registration_day'] = now();
        if ($hasToken) {
            $user = $request->user();
            if ($user) {
                $data['user_id'] = $user->id;
            }
        }

        $article = $this->articlesRepository->find($data['article_id']);
        if (!$article) {
            return [
                'status' => 404,
                'message' => __('Bài đăng không tồn tại!')
            ];
        }
        $userCheck = $article->user_id;
        if ($userCheck) {
            return [
                'status' => 404,
                'message' => __('Bài đăng này không phải của Admin!')
            ];
        }
        $phoneCheck = $this->repository->checkPhone($article['id'], $data['phone']);
        if ($phoneCheck) {
            return [
                'status' => 409,
                'message' => __('Số điện thoại đã đăng ký bài đăng này!')
            ];
        }

        Notification::create([
            'user_id' => $data['user_id'] ?? null,
            'article_id' => $article->id,
            'title' => __('Có thành viên/khách hàng đăng ký bài đăng!'),
            'content' => __(
                'Bài đăng ' . $article->title . '</br>' .
                'Thông tin liên hệ đăng ký </br>' .
                'Họ tên: ' . $data['fullname'] . '</br>' .
                'Số điện thoại: ' . $data['phone'] . '</br>' .
                'Nhu cầu: ' . $data['needs']
            ),
            'admin_id' => $article->admin_id,
            'status' => NotificationEnum::NotSeen
        ]);

        $this->repository->create($data);

        return [
            'status' => 200,
            'message' => __('Đã gửi form đăng ký đến Admin!')
        ];
    }
}
