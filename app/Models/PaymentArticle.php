<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentArticle extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'payment_articles';


    public function article()
    {
        return $this->belongsTo(Articles::class, 'article_id', 'id');
    }
}
