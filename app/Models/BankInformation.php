<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInformation extends Model
{
    use HasFactory;

    protected $table = "bank_information";

    protected $guarded = [];

    protected $fillable = [
        'Id',
        'bank_name',
        'bank_branch',
        'bank_account',
        'bank_number',
        'id_user'
    ];
}
