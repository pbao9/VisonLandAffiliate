<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlesHouseTypes extends Model
{
    use HasFactory;

    protected $table = "articles_house_types";

    protected $guarded = [];

    protected $casts = [];

    public function houseType()
    {
        return $this->belongsTo(ArticlesHouseTypes::class, 'houseType_id', 'id');
    }
}
