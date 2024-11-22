<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $table = "commission";

    protected $guarded = [];

    protected $casts = [];

    // public function commisionArticle()
    // {
    //     return $this->belongsTo(Articles::class, 'commision_id', 'id');
    // }
}
