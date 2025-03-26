<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwicReq extends Model
{
    //
    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'owic_number',
        'photos',
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
