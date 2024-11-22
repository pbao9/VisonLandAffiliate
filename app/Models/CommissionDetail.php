<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionDetail extends Model
{
    use HasFactory;

    protected $table = "commission_detail";

    protected $guarded = [];


    protected $casts = [];

    public function articles()
    {
        return $this->belongsTo(Articles::class, 'article_id');
    }

    public function customerRegistrations()
    {
        return $this->belongsTo(CustomerRegistrations::class, 'customer_registration_id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
