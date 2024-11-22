<?php
namespace App\Admin\Http\Controllers\Customers;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Customer\CustomerSearchSelectResource;
use App\Admin\Repositories\Customers\CustomersRepositoryInterface;

class CustomersSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        CustomersRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => CustomerSearchSelectResource::collection($this->instance)
        ];
    }
}
