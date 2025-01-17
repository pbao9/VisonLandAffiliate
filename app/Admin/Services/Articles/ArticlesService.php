<?php

namespace App\Admin\Services\Articles;

use App\Admin\Services\Articles\ArticlesServiceInterface;
use App\Admin\Repositories\Articles\ArticlesRepositoryInterface;
use App\Models\Articles;
use App\Admin\Traits\Setup;
use App\Enums\Article\ArticleActiveStatus;
use App\Enums\Article\ArticleArticleStatus;
use App\Enums\Notification\NotificationEnum;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ArticlesService implements ArticlesServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(ArticlesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        $admin = $request->user();
        $admin_id = $admin->id;
        $this->data['admin_id'] = $admin_id;
        $houseTypeId = $this->data['houseType_id'];
        $this->data['active_status'] = ArticleActiveStatus::Published;
        $this->data['code'] = $this->createCodeUser();
        $this->data['time_end'] = Carbon::parse($this->data['time_start'])->addDays($this->data['active_days'])->format('Y-m-d');
        unset($this->data['houseType_id']);
        DB::beginTransaction();
        try {
            $this->data['image'] = $this->data['image'] ? explode(",", $this->data['image']) : null;
            $articles = $this->repository->create($this->data);
            $this->repository->attachCategories($articles, $houseTypeId);
            DB::commit();
            return $articles;
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return false;
        }
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();
        $houseTypeId = $this->data['houseType_id'];
        unset($this->data['houseType_id']);
        DB::beginTransaction();
        $article = $this->repository->find($this->data['id']);
        $user = $article->user_id;

        if ($this->data['active_status'] == ArticleArticleStatus::Approved) {
            Notification::create([
                'user_id' => $user,
                'article_id' => $this->data['id'],
                'title' => __('Bài viết đã được phê duyệt'),
                'admin_id' => 1,
                'status' => NotificationEnum::NotSeen
            ]);
        }


        try {
            $this->data['image'] = $this->data['image'] ? explode(",", $this->data['image']) : null;
            $articles = $this->repository->update($this->data['id'], $this->data);
            $this->repository->syncCategories($articles, $houseTypeId);
            DB::commit();
            return $articles;
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return false;
        }
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function deletePayment($id, $admin_id)
    {
        return $this->repository->deletePayment($id, $admin_id);
    }
}
