<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\CustomerRegistration\CustomerRegistrationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\User\{UserRoles, UserVip, UserGender, UserIdentifier};
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'fullname',
        'email',
        'phone',
        'address',
        'gender',
        'token_get_password',
        'password',
        'roles',
        'avatar',
        'cccd_number',
        'cccd_front_image',
        'cccd_back_image',
        'issued_by',
        'issued_day',
        'birthday',
        'parent_id',
        'CreatedOtp',
        'identifier',
        'otp',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles' => UserRoles::class,
        'gender' => UserGender::class,
        'vip' => UserVip::class,
        'active' => 'boolean'
    ];

    public function customers()
    {
        return $this->hasMany(Customers::class, 'user_id')->orderBy('position', 'asc');
    }

    public function bank()
    {
        return $this->hasMany(BankInformation::class, 'id_user', 'id')->orderBy('id', 'asc');
    }


    public function article_register()
    {
        return $this->hasMany(CustomerRegistrations::class, 'user_id', 'id')->orderBy('id', 'asc');
    }

    public function collaboration()
    {
        return $this->hasMany(Collaboration::class, 'user_id', 'id')->orderBy('id', 'asc');
    }

    public function commission()
    {
        return $this->hasMany(CommissionDetail::class, 'user_id', 'id')->orderBy('id', 'asc');
    }

    public function sumPaidAmountByType($type)
    {
        return $this->commission()
            ->where('type', $type)
            ->sum('paid_amount');
    }


    public function children()
    {
        return $this->hasMany(User::class, 'parent_id')->with('children');
    }
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id', 'id')->with('parent');
    }

    public function checkIdentifier()
    {
        return $this->status === UserIdentifier::Identified ? 'Đã xác thực' : 'Chưa xác thực';
    }

    public function checkStatusArticlePeding()
    {
        return $this->article_register()->where('status', CustomerRegistrationStatus::Waiting)->count();
    }
    public function checkStatusArticleApproved()
    {
        return $this->article_register()->where('status', CustomerRegistrationStatus::Approved)->count();
    }

    public function checkStatusArticleRejected()
    {
        return $this->article_register()->where('status', CustomerRegistrationStatus::Rejected)->count();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
