<?php

namespace App\Api\V1\Repositories\Customers;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface CustomersRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10, $status = null, $user_id = null);
    public function delete($id);
    public function findUser($user_id);
    public function checkPhone($article_id, $phone);
}
