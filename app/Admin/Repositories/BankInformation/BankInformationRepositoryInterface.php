<?php
namespace App\Admin\Repositories\BankInformation;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface BankInformationRepositoryInterface extends EloquentRepositoryInterface{
    public function GetBankInformationByUserId($userId);
  
}