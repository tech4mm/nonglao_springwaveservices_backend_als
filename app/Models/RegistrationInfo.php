<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationInfo extends Model
{
    //
    public function user()
{
    return $this->belongsTo(User::class);
}

    protected $fillable = [
        'user_id',
    'name',
    'gender',
    'nrc_number',
    'photos',
    ];

    protected $casts = [
        'photos' => 'array',
    ];
}
