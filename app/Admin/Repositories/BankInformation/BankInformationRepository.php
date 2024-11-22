<?php

namespace App\Admin\Repositories\BankInformation;

use App\Admin\Repositories\BankInformation\BankInformationRepositoryInterface;
use App\Admin\Repositories\EloquentRepository;
use App\Models\BankInformation;

class BankInformationRepository extends EloquentRepository implements BankInformationRepositoryInterface
{
    protected $select = [];
    public function getModel()
    {
        return BankInformation::class;
    }
    public function GetBankInformationByUserId($userId)
    {
        return $this->model->where("id_user", $userId)->get();
    }
}
