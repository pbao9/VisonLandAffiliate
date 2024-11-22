<?php

namespace App\Api\V1\Repositories\BankInformation;

use App\Admin\Repositories\BankInformation\BankInformationRepository as AdminBankInformationRepository;
use App\Api\V1\Repositories\Collaboration\CollaborationRepositoryInterface;
use App\Models\BankInformation;
use App\Models\Collaboration;
use App\Models\Customers;

class BankInformationRepository extends AdminBankInformationRepository implements BankInformationRepositoryInterface
{
    public function getModel()
    {
        return BankInformation::class;
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

    public function findUser($user_id)
    {
        $this->instance = $this->model->where('user_id', $user_id);

        if ($this->instance && $this->instance->exists()) {
            return $this->instance;
        }

        return false;
    }
}
