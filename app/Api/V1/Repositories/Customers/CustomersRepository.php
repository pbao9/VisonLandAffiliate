<?php

namespace App\Api\V1\Repositories\Customers;

use App\Admin\Repositories\Customers\CustomersRepository as AdminCustomersRepository;
use App\Api\V1\Repositories\Customers\CustomersRepositoryInterface;
use App\Models\Customers;

class CustomersRepository extends AdminCustomersRepository implements CustomersRepositoryInterface
{
    public function getModel()
    {
        return Customers::class;
    }

    public function findByID($id)
    {
        $this->instance = $this->model->where('id', $id)
            ->firstOrFail();

        if ($this->instance && $this->instance->exists()) {
            return $this->instance;
        }

        return null;
    }
    public function paginate($page = 1, $limit = 10, $status = null, $user_id = null)
    {
        $page = is_numeric($page) && $page > 0 ? (int) $page - 1 : 0;
        $limit = is_numeric($limit) && $limit > 0 ? (int) $limit : 10;

        $query = $this->model;



        if (!is_null($user_id) || !is_null($status)) {
            $query = $query->customer($user_id, $status);
        }

        $total = $query->count();

        $totalPages = (int) ceil($total / $limit);

        $this->instance = $query
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


    public function delete($id)
    {
        try {
            Customers::findOrFail($id)->delete();
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }


    public function findUser($user_id)
    {
        $this->instance = $this->model->where('user_id', $user_id);

        if ($this->instance && $this->instance->exists()) {
            return $this->instance;
        }

        return false;
    }

    public function checkPhone($article_id, $phone)
    {
        return $this->model->where('phone', $phone)
            ->where('article_id', $article_id)
            ->exists();
    }
}
