<?php

namespace App\Api\V1\Repositories\Collaboration;

use App\Admin\Repositories\EloquentRepositoryInterface;
use App\Models\Articles;

interface CollaborationRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10, $user_id = null);
    public function delete($id);
    public function findUser($user_id);
    public function checkUser($user_id, $article_id);
    public function getAllCommissionsByUser($user_id);
}
