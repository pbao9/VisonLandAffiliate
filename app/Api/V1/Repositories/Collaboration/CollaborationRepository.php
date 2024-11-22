<?php

namespace App\Api\V1\Repositories\Collaboration;

use App\Admin\Repositories\Collaboration\CollaborationRepository as AdminCollaborationRepository;
use App\Api\V1\Repositories\Collaboration\CollaborationRepositoryInterface;
use App\Api\V1\Repositories\Customers\CustomersRepositoryInterface;
use App\Enums\CommissionDetail\CommissionDetailType;
use App\Enums\CustomerRegistration\CustomerRegistrationStatus;
use App\Models\Articles;
use App\Models\Collaboration;
use App\Models\CommissionDetail;
use App\Models\Customers;

class CollaborationRepository extends AdminCollaborationRepository implements CollaborationRepositoryInterface
{
    public function getModel()
    {
        return Collaboration::class;
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
    public function paginate($page = 1, $limit = 10, $user_id = null)
    {
        $page = is_numeric($page) && $page > 0 ? (int) $page - 1 : 0;
        $limit = is_numeric($limit) && $limit > 0 ? (int) $limit : 10;

        $query = $this->model;

        if (!is_null($user_id)) {
            $query = $query->userCollab($user_id);
        }

        $total = $query->count();

        $totalPages = (int) ceil($total / $limit);

        $this->instance = $query
            ->offset($page * $limit)
            ->with('articles')
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

    public function checkUser($user_id, $article_id)
    {
        return $this->model->where('user_id', $user_id)
            ->where('article_id', $article_id)
            ->exists();
    }

    // Hoa hồng trực tiếp
    public function getAllCommissionsByUser($user_id)
    {
        // Đếm tổng số lượng đăng ký cho từng trạng thái
        $counts = CommissionDetail::where('user_id', $user_id)
            ->get()
            ->groupBy(function ($commission) {
                return $commission->customerRegistrations->status;
            })
            ->map(function ($group) {
                return $group->count();
            });

        // Tính tổng hoa hồng chỉ cho loại trực tiếp
        $totalAmounts = CommissionDetail::where('user_id', $user_id)
            ->where('type', CommissionDetailType::directCommission) // chỉ lấy hoa hồng trực tiếp
            ->get()
            ->reduce(function ($carry, $commission) {
                $carry['total_amount'] += $commission->total_amount;
                $carry['paid_amount'] += $commission->paid_amount;
                $carry['remaining_amount'] += $commission->remaining_amount;
                return $carry;
            }, ['total_amount' => 0, 'paid_amount' => 0, 'remaining_amount' => 0]);

        return [
            'total_register' => $counts->sum(),
            'status' => [
                'waiting' => $counts->get(CustomerRegistrationStatus::Waiting, 0),
                'approved' => $counts->get(CustomerRegistrationStatus::Approved, 0),
                'rejected' => $counts->get(CustomerRegistrationStatus::Rejected, 0),
            ],
            'total_commission' => [
                'total_amount' => $totalAmounts['total_amount'],
                'paid_amount' => $totalAmounts['paid_amount'],
                'remaining_amount' => $totalAmounts['remaining_amount'],
            ],
        ];
    }
}
