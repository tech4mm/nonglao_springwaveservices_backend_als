<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DependencyRelative extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'e_title',
        'e_body',
        'm_title',
        'm_body',
        't_title',
        't_body',
        's_title',
        's_body',
        'type',
    ];
}
