<?php

namespace App\Models;

use App\Enums\Article\ArticleActiveStatus;
use App\Enums\Article\ArticleArticleStatus;
use Illuminate\Console\View\Components\Warn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use App\Admin\Support\Eloquent\Sluggable;

class Articles extends Model
{
    use HasFactory, Sluggable;

    protected $table = "articles";
    protected $columnSlug = 'title';

    protected $guarded = [];

    protected $casts = [
        'image' => AsArrayObject::class,
        'broker_id' => AsArrayObject::class,
        'houseType_id' => AsArrayObject::class,
    ];

    public function customerRegistrations()
    {
        return $this->hasMany(CustomerRegistrations::class, 'article_id');
    }

    public function articleAdmin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function getInfoAdmin()
    {
        if ($this->articleAdmin) {
            return [
                'fullname' => $this->articleAdmin->fullname,
                'avatar' => $this->articleAdmin->avatar ?? asset(config('custom.images.avatar')),
            ];
        }

        return null;
    }

    public function articleUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function getInfoUser()
    {
        if ($this->articleUser) {
            return [
                'fullname' => $this->articleUser->fullname,
                'avatar' => asset($this->articleUser->avatar) ?? asset(config('custom.images.avatar')),
            ];
        }

        return null;
    }


    public function articleProvince()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function getNameProvince()
    {
        return $this->articleProvince ? $this->articleProvince->name : null;
    }

    public function articleDistrict()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function getNameDistrict()
    {
        return $this->articleDistrict ? $this->articleDistrict->name : null;
    }

    public function articleWard()
    {
        return $this->belongsTo(Wards::class, 'ward_id', 'id');
    }


    public function getNameWard()
    {
        return $this->articleWard ? $this->articleWard->name : null;
    }

    public function articleArea()
    {
        return $this->belongsTo(Areas::class, 'area_id', 'id');
    }


    public function getTitleArea()
    {
        return $this->articleArea ? $this->articleArea->name : null;
    }

    public function articleHouseType()
    {
        return $this->belongsTo(HouseType::class, 'houseType_id', 'id');
    }

    public function commission_detail()
    {
        return $this->belongsTo(CommissionDetail::class, 'article_id');
    }

    public function commission()
    {
        return $this->belongsTo(Commission::class, 'commission_id', 'id');
    }

    public function collaboration()
    {
        return $this->hasMany(Collaboration::class, 'article_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(HouseType::class, 'articles_house_types', 'article_id', 'houseType_id');
    }

    public function getNameHouseType()
    {
        if ($this->categories && $this->categories->isNotEmpty()) {
            return $this->categories->pluck('name')->implode(', ');
        }

        return null;
    }

    public function scopePublished($query)
    {
        return $query->where('active_status', ArticleArticleStatus::Approved);
    }

    public function payment()
    {
        return $this->hasOne(PaymentArticle::class, 'article_id', 'id');
    }

    public function checkUser($user_id, $article_id)
    {
        return self::where('id', $article_id)
            ->where('user_id', $user_id)
            ->exists();
    }
}
