<?php

namespace App\Api\V1\Repositories\BankInformation;

use App\Admin\Repositories\EloquentRepositoryInterface;


interface BankInformationRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByID($id);
    public function paginate($page = 1, $limit = 10, $status = null, $user_id = null);
    public function findUser($user_id);
}
