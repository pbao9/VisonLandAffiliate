<?php

namespace App\Admin\Repositories\Broker;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface BrokerRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * make query
     * 
     * @return mixed
     */
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}