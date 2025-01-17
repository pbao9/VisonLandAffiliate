<?php

namespace App\Models;

use App\Enums\Notification\NotificationEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = "notification";

    protected $guarded = [];

    protected $casts = [
        'status' => NotificationEnum::class,
    ];

    protected $fillable = [
        'id',
        'user_id',
        'article_id',
        'title',
        'content',
        'admin_id',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    public function getAllByAdmin($adminId)
    {
        return $this->where('admin_id', $adminId)->get();
    }

    public function getAdmin()
    {
        return $this->admin ? $this->admin->fullname : null;
    }

    public function article()
    {
        return $this->belongsTo(Articles::class, 'article_id', 'id');
    }
}
