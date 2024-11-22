<?php

namespace App\Api\V1\Repositories\CustomerRegistrations;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface CustomerRegistrationsRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10);
    public function delete($id);
    public function checkPhone($article_id, $phone);
    public function getUserJoin($user);
}
