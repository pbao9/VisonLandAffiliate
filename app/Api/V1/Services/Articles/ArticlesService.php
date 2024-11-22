<?php

namespace App\Api\V1\Services\Articles;

use App\Admin\Services\File\FileService;
use App\Admin\Services\File\GalleryService;
use App\Api\V1\Services\Articles\ArticlesServiceInterface;
use App\Api\V1\Repositories\Articles\ArticlesRepositoryInterface;
use App\Enums\Article\ArticleArticleStatus;
use Illuminate\Http\Request;
use App\Api\V1\Support\AuthSupport;
use App\Admin\Traits\Setup;
use App\Api\V1\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Notification\NotificationEnum;
use App\Enums\User\UserIdentifier;
use App\Models\Admin;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ArticlesService implements ArticlesServiceInterface
{
    use Setup;
    use AuthSupport;
    protected FileService $fileService;
    protected GalleryService $galleryService;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    protected $repositorySetting;

    public function __construct(
        ArticlesRepositoryInterface $repository,
        FileService $fileService,
        GalleryService $galleryService,
        SettingRepositoryInterface $repositorySetting,
    ) {
        $this->repository = $repository;
        $this->fileService = $fileService;
        $this->galleryService = $galleryService;
        $this->repositorySetting = $repositorySetting;
    }

    public function add(Request $request)
    {
        $validatedData = $request->validated();
        $user = $request->user();
        $user_id = $user->id;

        if ($user->identifier === UserIdentifier::Identified) {
            $validatedData['user_id'] = $user_id;
            $validatedData['code'] = $this->createCodeUser();
            $validatedData['time_end'] = Carbon::parse($validatedData['time_start'])->addDays($validatedData['active_days'])->format('Y-m-d');
            $houseTypeId = $validatedData['houseType_id'] ?? null;
            unset($validatedData['houseType_id']);

            if (array_key_exists('image', $validatedData)) {
                $validatedData['image'] = $validatedData['image']
                    ? $this->galleryService->uploadGallery('articles', $validatedData['image'], $validatedData['image'])
                    : null;
            } else {
                $validatedData['image'] = null;
            }

            $default_post = $this->repositorySetting->getValueByKey('default');
            $vip_post = $this->repositorySetting->getValueByKey('vip');
            $typePost = $validatedData['status'];

            if ($typePost == 1) {
                $price_post_type = $validatedData['active_days'] * $default_post;
            } elseif ($typePost == 2) {
                $price_post_type = $validatedData['active_days'] * $vip_post;
            }

            if ($validatedData['active_days'] <= 7) {
                return [
                    'status' => 400,
                    'message' => __('Vui lòng đăng trên 7 ngày!')
                ];
            }



            $validatedData['price_post_type'] = $price_post_type;

            $articles = $this->repository->create($validatedData);

            if ($houseTypeId) {
                $this->repository->attachCategories($articles, $houseTypeId);
            }

            $admins = Admin::all();

            foreach ($admins as $admin) {
                Notification::create([
                    'article_id' => $articles->id,
                    'title' => 'Có thành viên mới đăng bài!',
                    'content' => 'Bài đăng: "' . $articles->title . ' ID: Bài đăng - ' . $articles->id . '"',
                    'admin_id' => $admin->id,
                    'status' => NotificationEnum::NotSeen,
                ]);
            }

            return [
                'status' => 200,
                'message' => __('Tạo bài đăng thành công! Vui lòng thanh toán ' . number_format($price_post_type) . 'đ' . ' cho admin!')
            ];
        }

        return [
            'status' => 403,
            'message' => __('Vui lòng hoàn thành xác thực định danh!')
        ];
    }

    public function edit(Request $request)
    {
        $requestData = $request->all();
        $article = $this->repository->find($requestData['id']);

        if (!isset($requestData['id'])) {
            return [
                'status' => 400,
                'message' => __('Trường id là bắt buộc.')
            ];
        }
        if (!$article) {
            return [
                'status' => 404,
                'message' => __('Bài viết không tồn tại.')
            ];
        }
        $userId = $request->user()->id;
        if (is_null($article->user_id) || $article->user_id !== $userId) {
            return [
                'status' => 403,
                'message' => __('Bạn không có quyền chỉnh sửa bài viết này.')
            ];
        }
        try {
            $houseTypeId = $requestData['houseType_id'] ?? null;
            unset($requestData['houseType_id']);
            if (array_key_exists('image', $requestData)) {
                $requestData['image'] = $requestData['image']
                    ? $this->galleryService->uploadGallery('articles', $requestData['image'], $requestData['image'])
                    : null;
            } else {
                $requestData['image'] = null;
            }

            $requestData['houseType_id'] = $houseTypeIdString ?? null;
            $article->update($requestData);

            if ($houseTypeId) {
                $this->repository->syncCategories($article, $houseTypeId);
            }

            return [
                'status' => 200,
                'message' => __('Cập nhật thành công.')
            ];
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'message' => __('Cập nhật thất bại: ') . $e->getMessage(),
            ];
        }
    }


    public function delete(Request $request)
    {
        $requestData = $request->all();

        if (!isset($requestData['id'])) {
            return [
                'status' => 400,
                'message' => __('Trường id là bắt buộc.')
            ];
        }

        $article = $this->repository->find($requestData['id']);
        if (!$article) {
            return [
                'status' => 404,
                'message' => __('Bài viết không tồn tại.')
            ];
        }

        $userId = $request->user()->id;

        if (is_null($article->user_id) || $article->user_id !== $userId) {
            return [
                'status' => 403,
                'message' => __('Bạn không có quyền xóa bài viết này.')
            ];
        }

        try {
            $article->delete($requestData);
            return [
                'status' => 200,
                'message' => __('Xóa thành công')
            ];
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'message' => __('Xóa thất bại thất bại: ') . $e->getMessage(),
            ];
        }
    }



    public function payment(Request $request)
    {
        $this->data = $request->validated();

        $article_id = $this->data['article_id'];
        $document = $this->data['document'];
        $user_id = $request->user()->id;

        $articles = $this->repository->find($article_id);

        if (!$articles) {
            return [
                'status' => 404,
                'message' => __('Bài đăng không tồn tại!')
            ];
        }

        $userExists = $this->repository->checkUser($articles, $user_id, $article_id);

        if (!$userExists) {
            return [
                'status' => 403,
                'message' => __('Bài đăng không thuộc của bạn! Vui lòng kiểm tra lại!')
            ];
        }

        $exists = $this->repository->checkIfPaymentExists($article_id);

        if ($exists) {
            return [
                'status' => 409,
                'message' => __('Đã gửi xác thực thanh toán, vui lòng chờ để duyệt!')
            ];
        }

        if (isset($this->data['document'])) {
            $document = $this->fileService->uploadAvatar('documents', $document, $articles);
        }

        $articles->active_status = ArticleArticleStatus::Pending;

        $this->repository->update($article_id, [
            'active_status' => $articles->active_status,
        ]);
        $this->repository->attachPayment($articles, $document);

        return [
            'status' => 200,
            'message' => __('Đã gửi ảnh chứng từ đến Admin')
        ];
    }
}
