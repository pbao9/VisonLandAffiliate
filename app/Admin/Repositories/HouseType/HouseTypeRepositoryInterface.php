<?php

namespace App\Admin\Repositories\HouseType;

use App\Admin\Repositories\EloquentRepositoryInterface;

interface HouseTypeRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * make query
     *
     * @return mixed
     */
    public function getHouseType();
    public function getQueryBuilderByColumns($column, $value);
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function searchAllLimit($value = '', $meta = [], $select = [], $limit = 10);
    // public function getHouseTypesByIds($houseTypeIds);

}
