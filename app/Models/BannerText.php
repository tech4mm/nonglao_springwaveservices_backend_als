<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerText extends Model
{
    //
        use HasFactory;
    protected $fillable = [
        'e_body',
        'm_body',
        't_body',
        's_body',
    ];
}
