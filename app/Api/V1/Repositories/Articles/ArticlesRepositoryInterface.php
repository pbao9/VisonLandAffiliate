<?php

namespace App\Api\V1\Repositories\Articles;

use App\Admin\Repositories\EloquentRepositoryInterface;
use App\Models\Articles;

interface ArticlesRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
    public function delete($id);
    public function attachPayment(Articles $articles, $document);
    public function checkIfPaymentExists($article_id);
    public function checkUser(Articles $articles, $user_id, $article_id);
    public function findAndSearchWithRelation($id = null, array $criteria = [], $page = 1, $limit = 10);
    public function findAndSearchForUser($id = null, array $criteria = [], $page = 1, $limit = 10, $user_id);
    public function attachCategories(Articles $articles, array $houseTypeId);
    public function syncCategories(Articles $articles, array $houseTypeId);
    public function checkArticle(Articles $articles);
}
