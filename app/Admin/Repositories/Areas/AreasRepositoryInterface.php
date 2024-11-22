<?php

namespace App\Admin\Repositories\Areas;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface AreasRepositoryInterface extends EloquentRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');

    public function getArea();
    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'name'], $limit = 10);
    
}
