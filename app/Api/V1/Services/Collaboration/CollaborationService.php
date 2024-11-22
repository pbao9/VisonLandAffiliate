<?php

namespace App\Api\V1\Services\Collaboration;

use App\Api\V1\Repositories\Articles\ArticlesRepositoryInterface;
use App\Api\V1\Repositories\Collaboration\CollaborationRepositoryInterface;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Api\V1\Support\AuthSupport;

class CollaborationService implements CollaborationServiceInterface
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
    protected $userRepository;

    public function __construct(
        CollaborationRepositoryInterface $repository,
        ArticlesRepositoryInterface $articleRepository,
        UserRepositoryInterface $userRepository,
    ) {
        $this->repository = $repository;
        $this->articleRepository = $articleRepository;
        $this->userRepository = $userRepository;
    }

    public function add(Request $request)
    {
        $user = $request->user()->id;

        $data = $request->validated();
        $article = $this->articleRepository->find($data['article_id']);
        $user_i4 = $this->userRepository->find($user);

        $cleanedTitle = str_replace(' ', '', $article->id);
        $cleanedCode = str_replace(' ', '', $user_i4->code);

        $data['short_link'] = config('app.url') . '/api/v1/articles/view-article' . '/' . $cleanedTitle . '/' . $cleanedCode;

        $data['user_id'] = $user;

        $userExists = $this->repository->checkUser($user, $article->id);

        $articleCheck = $this->articleRepository->checkArticle($article);

        // Kiểm tra nếu user_id có tồn tại thì không cho hợp tác
        if ($articleCheck) {
            return [
                'status' => 400,
                'message' => __('Dự án này không có thể hợp tác. Vui lòng kiểm tra lại!')
            ];
        }

        // Kiểm tra nếu có user_id thuộc article_id đã tồn tại thì hông cho hợp tác lần nữa
        if ($userExists) {
            return [
                'status' => 403,
                'message' => __('Bạn đã hợp tác với dự án này! Vui lòng kiểm tra lại')
            ];
        }

        $this->repository->create($data);

        return [
            'status' => 200,
            'message' => __('Bạn đã liên hệ hợp tác thành công!')
        ];
    }
}
