<?php

namespace App\Observers;

use App\Enums\CommissionDetail\CommissionDetailStatus;
use App\Enums\CommissionDetail\CommissionDetailType;
use App\Models\CommissionDetail;
use App\Models\CustomerRegistrations;
use Illuminate\Support\Facades\Log;

class CustomerRegistrationObserver
{
    /**
     * Handle the CustomerRegistrations "created" event.
     *
     * @param  \App\Models\CustomerRegistrations  $customerRegistrations
     * @return void
     */
    public function created(CustomerRegistrations $customerRegistrations)
    {
        // Trường hợp có mã giới thiệu thì sẽ lấy user mã giới thiệu là direct, user cha của user đăng ký là indirect
        // D mua nhập mã giới thiệu user A (Nhận hoa hồng trực tiếp), D là con của C (Nhận hoa hồng gián tiếp)

        if ($customerRegistrations->referal) {
            CommissionDetail::create([
                'customer_registration_id' => $customerRegistrations->id,
                'user_id' => $customerRegistrations->referal->id,
                'type' => CommissionDetailType::directCommission,
                'total_amount' => 0,
                'status' => CommissionDetailStatus::Waiting,
            ]);
            Log::info("Parent", ['parent' => $customerRegistrations->referal->parent]);
            if (
                ($customerRegistrations->users && $customerRegistrations->users->parent) ||
                ($customerRegistrations->referal && $customerRegistrations->referal->parent)
            ) {
                CommissionDetail::create([
                    'customer_registration_id' => $customerRegistrations->id,
                    'user_id' => $customerRegistrations->users->parent->id ?? $customerRegistrations->referal->parent->id,
                    'total_amount' => 0,
                    'type' => CommissionDetailType::inDirectCommission,
                    'status' => CommissionDetailStatus::Waiting,
                ]);
            }
        } else {
            if ($customerRegistrations->users || ($customerRegistrations->referal && $customerRegistrations->referal->parent)) {
                $userId = $customerRegistrations->referal->parent->id ?? ($customerRegistrations->users->parent->id ?? null);
                if ($userId) {
                    CommissionDetail::create([
                        'customer_registration_id' => $customerRegistrations->id,
                        'user_id' => $userId,
                        'total_amount' => 0,
                        'type' => CommissionDetailType::directCommission,
                        'status' => CommissionDetailStatus::Waiting,
                    ]);
                }
            }

            if (
                ($customerRegistrations->users && $customerRegistrations->users->parent) ||
                ($customerRegistrations->referal && $customerRegistrations->referal->parent && $customerRegistrations->referal->parent->parent)
            ) {

                $indirectUserId = ($customerRegistrations->referal->parent->parent->id ?? null) ??
                    ($customerRegistrations->users->parent->parent->id ?? null);

                if ($indirectUserId) {
                    CommissionDetail::create([
                        'customer_registration_id' => $customerRegistrations->id,
                        'user_id' => $indirectUserId,
                        'type' => CommissionDetailType::inDirectCommission,
                        'status' => CommissionDetailStatus::Waiting,
                        'total_amount' => 0,
                    ]);
                }
            }
        }
    }

    /**
     * Handle the CustomerRegistrations "updated" event.
     *
     * @param  \App\Models\CustomerRegistrations  $customerRegistrations
     * @return void
     */
    public function updated(CustomerRegistrations $customerRegistrations)
    {
        $article = $customerRegistrations->articles;
        $commission = $article->commission;

        // Tính toán hoa hồng trực tiếp và gián tiếp dựa trên số lượng bán
        $commissionDirect = $commission->direct_commission * $customerRegistrations->amount_sold / 100;
        $commissionIndirect = $commission->indirect_commission * $customerRegistrations->amount_sold / 100;

        // Tạo hoa hồng trực tiếp cho người giới thiệu (nếu có mã giới thiệu trong đăng ký)
        if ($customerRegistrations->referal) {
            CommissionDetail::updateOrCreate(
                [
                    'customer_registration_id' => $customerRegistrations->id,
                    'user_id' => $customerRegistrations->referal->id,
                    'type' => CommissionDetailType::directCommission,
                ],
                [
                    'total_amount' => $commissionDirect,
                    'remaining_amount' => $commissionDirect,
                    'status' => CommissionDetailStatus::Waiting,
                ]
            );

            // Tạo hoa hồng gián tiếp cho cha của người giới thiệu (nếu có)
            if ($customerRegistrations->referal->parent) {
                CommissionDetail::updateOrCreate(
                    [
                        'customer_registration_id' => $customerRegistrations->id,
                        'user_id' => $customerRegistrations->referal->parent->id,
                        'type' => CommissionDetailType::inDirectCommission,
                    ],
                    [
                        'total_amount' => $commissionIndirect,
                        'remaining_amount' => $commissionIndirect,
                        'status' => CommissionDetailStatus::Waiting,
                    ]
                );
            }
        }

        // Tạo hoa hồng trực tiếp cho người dùng cấp cha (nếu không có mã giới thiệu trong đăng ký)
        if ($customerRegistrations->users && $customerRegistrations->users->parent) {
            CommissionDetail::updateOrCreate(
                [
                    'customer_registration_id' => $customerRegistrations->id,
                    'user_id' => $customerRegistrations->users->parent->id,
                    'type' => CommissionDetailType::directCommission,
                ],
                [
                    'total_amount' => $commissionDirect,
                    'remaining_amount' => $commissionDirect,
                    'status' => CommissionDetailStatus::Waiting,
                ]
            );

            // Kiểm tra tồn tại cha của cha (cấp ông) và tạo hoa hồng gián tiếp (nếu có)
            if ($customerRegistrations->users->parent->parent) {
                CommissionDetail::updateOrCreate(
                    [
                        'customer_registration_id' => $customerRegistrations->id,
                        'user_id' => $customerRegistrations->users->parent->parent->id,
                        'type' => CommissionDetailType::inDirectCommission,
                    ],
                    [
                        'total_amount' => $commissionIndirect,
                        'remaining_amount' => $commissionIndirect,
                        'status' => CommissionDetailStatus::Waiting,
                    ]
                );
            }
        }
    }

    /**
     * Handle the CustomerRegistrations "deleted" event.
     *
     * @param  \App\Models\CustomerRegistrations  $customerRegistrations
     * @return void
     */
    public function deleted(CustomerRegistrations $customerRegistrations)
    {
        //
    }

    /**
     * Handle the CustomerRegistrations "restored" event.
     *
     * @param  \App\Models\CustomerRegistrations  $customerRegistrations
     * @return void
     */
    public function restored(CustomerRegistrations $customerRegistrations)
    {
        //
    }

    /**
     * Handle the CustomerRegistrations "force deleted" event.
     *
     * @param  \App\Models\CustomerRegistrations  $customerRegistrations
     * @return void
     */
    public function forceDeleted(CustomerRegistrations $customerRegistrations)
    {
        //
    }
}
