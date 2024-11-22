<?php

namespace App\Admin\Repositories\Articles;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Articles\ArticlesRepositoryInterface;
use App\Enums\Article\ArticleArticleStatus;
use App\Enums\Notification\NotificationEnum;
use App\Models\Articles;
use App\Models\Notification;
use App\Models\PaymentArticle;
use App\Models\Province;

class ArticlesRepository extends EloquentRepository implements ArticlesRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Articles::class;
    }
    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'title', 'code', 'operative_management'], $limit = 10)
    {
        $this->instance = $this->model->select($select);
        $this->getQueryBuilderFindByKey($keySearch);

        foreach ($meta as $key => $value) {
            $this->instance = $this->instance->where($key, $value);
        }

        return $this->instance->limit($limit)->get();
    }


    protected function getQueryBuilderFindByKey($key)
    {
        $this->instance = $this->instance->where(function ($query) use ($key) {
            return $query->where('title', 'LIKE', '%' . $key . '%')
                ->orWhere('code', 'LIKE', '%' . $key . '%')
                ->orWhere('slug', 'LIKE', '%' . $key . '%')
                ->orWhere('utilities', 'LIKE', '%' . $key . '%');
        });
    }
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }

    public function attachCategories(Articles $articles, array $houseTypeId)
    {
        return $articles->categories()->attach($houseTypeId);
    }


    public function attachPayment(Articles $articles, $document)
    {
        return $articles->payment()->create([
            'document' => $document,
        ]);
    }


    public function deletePayment($id, $admin_id)
    {
        $article = $this->model->find($id);

        if ($article) {
            Notification::create([
                'user_id' => $article->user_id,
                'article_id' => $article->id,
                'title' => 'Vui lòng hoàn tất thanh toán',
                'content' => 'Ảnh thanh toán của bạn không hợp lệ vui lòng kiểm tra và thanh toán lại cho Admin!',
                'admin_id' => $admin_id,
                'status' => NotificationEnum::NotSeen
            ]);
            $article->active_status = ArticleArticleStatus::Waiting;
            $article->save();
            return $article->payment()->delete();
        }

        return false;
    }

    public function checkIfPaymentExists($article_id)
    {
        return PaymentArticle::where('article_id', $article_id)->exists();
    }


    public function checkUser(Articles $articles, $user_id, $article_id)
    {
        return $articles->checkUser($user_id, $article_id);
    }

    public function checkArticle(Articles $articles)
    {
        return $this->model->where('id', $articles->id)->whereNotNull('user_id')->exists();
    }

    public function syncCategories(Articles $articles, array $houseTypeId)
    {
        return $articles->categories()->sync($houseTypeId);
    }
    public function findAll()
    {
        return Articles::all();
    }

    public function getProvince()
    {
        return Province::all();
    }
}
