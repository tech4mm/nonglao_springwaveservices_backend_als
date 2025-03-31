<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    //
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image',
        'fcm_token',
        'status'
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}
}
