<?php

namespace App\Models;

use App\Enums\Customer\CustomerStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = "customers";

    protected $guarded = [];

    protected $casts = [
        'status' => CustomerStatus::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function customerRegistrations()
    {
        return $this->hasMany(CustomerRegistrations::class, 'user_id');
    }

    public function scopeCustomer($query, $user_id, $status)
    {
        if (!is_null($user_id)) {
            $query->where('user_id', $user_id);
        }

        if (!is_null($status)) {
            $query->where('status', $status);
        }

        return $query;
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
