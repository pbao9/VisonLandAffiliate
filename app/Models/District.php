<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $guarded = [];

    protected $casts = [];

    public function ward()
    {
        return $this->hasMany(Wards::class, 'district_id', 'id');
    }
}
