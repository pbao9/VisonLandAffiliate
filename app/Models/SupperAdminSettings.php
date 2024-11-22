<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupperAdminSettings extends Model
{
    use HasFactory;

    protected $table = "supperadmin_settings";

    protected $guarded = [];

    protected $casts = [];
}
