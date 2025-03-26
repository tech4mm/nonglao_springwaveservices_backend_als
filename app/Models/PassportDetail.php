<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PassportDetail extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'photo',
        'name',
        'passport_type',
        'passport_number',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'date_of_issue',
        'place_of_issue',
        'passport_expire_date'
    ];
    protected $casts = [
    'photo' => 'array',
];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
