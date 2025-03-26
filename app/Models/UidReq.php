<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UidReq extends Model
{
    //
    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'uid_number',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
