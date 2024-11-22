<?php

namespace App\Api\V1\Repositories\Address\Ward;

use App\Admin\Repositories\EloquentRepository;
use App\Models\District;
use App\Models\Ward;
use App\Models\Wards;

class WardRepository extends EloquentRepository implements WardRepositoryInterface
{
    public function getModel()
    {
        return Wards::class;
    }

    public function getAll()
    {
        $this->instance = $this->model->all();
        return $this->instance;
    }


    public function getProvinceDistrict()
    {
        $this->instance = $this->model->with(['district'])->get();

        return $this->instance;
    }


    public function paginate($page = 1, $limit = 10)
    {
        $page = is_numeric($page) && $page > 0 ? (int)$page - 1 : 0;
        $limit = is_numeric($limit) && $limit > 0 ? (int)$limit : 10;

        $total = $this->model->count();

        $totalPages = (int)ceil($total / $limit);

        $this->instance = $this->model
            ->offset($page * $limit)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->get();

        return [
            'data' => $this->instance,
            'total' => $total,
            'totalPages' => $totalPages,
            'currentPage' => $page + 1,
            'hasPrev' => $page > 0,
            'hasNext' => $page < $totalPages - 1,
        ];
    }
}
