<?php

namespace App\Models;

use App\Enums\CustomerRegistration\CustomerRegistrationStatus;
use App\Enums\CustomerRegistration\CustomerRegistrationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRegistrations extends Model
{
    use HasFactory;

    protected $table = "customer_registrations";

    protected $guarded = [];

    protected $casts = [
        'status' => CustomerRegistrationStatus::class,
    ];

    public function articles()
    {
        return $this->belongsTo(Articles::class, 'article_id');
    }

    public function commission_detail()
    {
        return $this->belongsTo(CommissionDetail::class, 'article_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function referal()
    {
        return $this->belongsTo(User::class, 'referal_code', 'code');
    }


    public function customers()
    {
        return $this->belongsTo(Customers::class, 'user_id');
    }
}
