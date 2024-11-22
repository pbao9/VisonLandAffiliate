<?php

namespace App\Admin\Http\Controllers\Brokers;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\Broker\BrokerSearchSelectResource;
use App\Admin\Repositories\Broker\BrokerRepositoryInterface;

class BrokerSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        BrokerRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => BrokerSearchSelectResource::collection($this->instance)
        ];
    }
}
