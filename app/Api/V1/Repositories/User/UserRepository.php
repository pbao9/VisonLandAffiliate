<?php

namespace App\Api\V1\Repositories\User;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Traits\Setup;
use App\Api\V1\Mail\Auth\OtpMail;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Enums\CommissionDetail\CommissionDetailType;
use App\Enums\CustomerRegistration\CustomerRegistrationStatus;
use App\Models\CommissionDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{

    use Setup;
    protected $select = [];

    public function getModel()
    {
        return User::class;
    }
    public function findByKey($key, $value)
    {
        $this->instance = $this->model->where($key, $value)->first();
        return $this->instance;
    }

    public function updateObject($user, $data)
    {
        $user->update($data);
        return $user;
    }
    public function getUserFirst()
    {
        return $this->model->first();
    }
    public function SendOtp($email)
    {
        $user = $this->model->where("email", $email)->first();
        if (!$user) {
            return 'Không tìm thấy người dùng';
        }
        $otpCreatedAt = Carbon::parse($user->CreatedOtp);
        $otpExpiryMinutes = 2;
        if (Carbon::now()->diffInMinutes($otpCreatedAt) <= $otpExpiryMinutes) {
            return 'Vui lòng chờ ít nhất 2 phút trước khi yêu cầu mã OTP mới';
        }
        $otp = $this->generateOtp();
        Mail::to($email)->send(new OtpMail($otp));
        $user->otp = $otp;
        $user->CreatedOtp = Carbon::now();
        $user->save();
        return true;
    }
    public function CheckOtp($email, $otp)
    {
        $user = $this->model->where('email', $email)->first();
        if (!$user) {
            return 'Không tìm thấy người dùng';
        }
        if ($user->otp !== $otp) {
            return 'Otp không hợp lệ';
        }
        $otpCreatedAt = Carbon::parse($user->CreatedOtp);
        $otpExpiryMinutes = 2;
        if (Carbon::now()->diffInMinutes($otpCreatedAt) > $otpExpiryMinutes) {
            return 'OTP đã hết hạn';
        }
        $user->active = 1;
        $user->save();
        return "Kiểm tra thành công Otp";
    }


    public function checkUserChild($user_id, $parent_id)
    {
        $user = $this->model->where('id', $user_id)->where('parent_id', $parent_id)->first();

        return $user;
    }


    public function getAllCommission($user_id)
    {
        $user = $this->model->where('id', $user_id);
        return $user;
    }


    public function getAllCommissionsByUserIndirect($user_id)
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
            ->where('type', CommissionDetailType::inDirectCommission) // chỉ lấy hoa hồng trực tiếp
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
