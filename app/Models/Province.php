<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';

    protected $guarded = [];

    protected $casts = [];

    public function district()
    {
        return $this->hasMany(District::class, 'province_id', 'id');
    }
}
