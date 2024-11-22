<?php

namespace App\Models;

use App\Enums\CommissionDetail\CommissionDetailType;
use App\Enums\CustomerRegistration\CustomerRegistrationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Html\Editor\Fields\BelongsTo;

class Collaboration extends Model
{
    use HasFactory;

    protected $table = 'collaborations';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function articles()
    {
        return $this->belongsTo(Articles::class, 'article_id', 'id');
    }

    public function scopeUserCollab($query, $user_id)
    {
        if (!is_null($user_id)) {
            $query->where('user_id', $user_id);
        }
        return $query;
    }


    public function checkUser($user_id, $article_id)
    {
        return self::where('id', $article_id)
            ->where('user_id', $user_id)
            ->exists();
    }


    public function getArticleRegistersCountByUserAndArticle($user_id, $article_id)
    {
        $parent = $this->users->find($user_id)->parent;

        // Lấy số lượng commission cho từng trạng thái
        $counts = CommissionDetail::where('user_id', $user_id)
            ->whereHas('customerRegistrations', function ($query) use ($article_id) {
                $query->where('article_id', $article_id);
            })
            ->get()
            ->groupBy(function ($commission) {
                return $commission->customerRegistrations->status;
            })
            ->map(function ($group) {
                return $group->count();
            });
        // Thay parent thành user_id nếu lấy theo hoa hồng của user_id không phải của parent
        $totalAmounts = CommissionDetail::where('user_id', $parent)
            ->whereHas('customerRegistrations', function ($query) use ($article_id) {
                $query->where('article_id', $article_id);
            })
            ->whereIn('type', [CommissionDetailType::directCommission, CommissionDetailType::inDirectCommission])
            ->get()
            ->groupBy('type')
            ->map(function ($commissions) {
                return [
                    'total_amount' => $commissions->sum('total_amount'),
                    'paid_amount' => $commissions->sum('paid_amount'),
                    'remaining_amount' => $commissions->sum('remaining_amount'),
                ];
            });

        $totalAmountDirect = $totalAmounts->get(CommissionDetailType::directCommission, [
            'total_amount' => 0,
            'paid_amount' => 0,
            'remaining_amount' => 0,
        ]);

        $totalAmountIndirect = $totalAmounts->get(CommissionDetailType::inDirectCommission, [
            'total_amount' => 0,
            'paid_amount' => 0,
            'remaining_amount' => 0,
        ]);


        return [
            'total_register' => $counts->sum(),
            'status' => [
                'waiting' => $counts->get(CustomerRegistrationStatus::Waiting, 0),
                'approved' => $counts->get(CustomerRegistrationStatus::Approved, 0),
                'rejected' => $counts->get(CustomerRegistrationStatus::Rejected, 0),
            ],
            'direct_commission' => [
                'total_amount_direct' => $totalAmountDirect['total_amount'],
                'paid_amount_direct' => $totalAmountDirect['paid_amount'],
                'remaining_amount_direct' => $totalAmountDirect['remaining_amount'],
            ],
            'indirect_commission' => [
                'total_amount_indirect' => $totalAmountIndirect['total_amount'],
                'paid_amount_indirect' => $totalAmountIndirect['paid_amount'],
                'remaining_amount_indirect' => $totalAmountIndirect['remaining_amount'],
            ]
        ];
    }
}
