<?php

namespace App\Admin\Repositories\Articles;

use App\Admin\Repositories\EloquentRepositoryInterface;
use App\Models\Articles;

interface ArticlesRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchAllLimit($value = '', $meta = [], $select = [], $limit = 10);
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function attachCategories(Articles $articles, array $houseTypeId);
    public function syncCategories(Articles $articles, array $houseTypeId);
    public function attachPayment(Articles $articles, $document);
    public function checkIfPaymentExists($article_id);
    public function checkUser(Articles $articles, $user_id, $article_id);
    public function deletePayment($id, $admin_id);
    public function checkArticle(Articles $articles);
}
