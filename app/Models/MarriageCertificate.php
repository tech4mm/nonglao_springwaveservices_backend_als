<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarriageCertificate extends Model
{
    //
        use HasFactory;

    protected $fillable = ['user_id', 'photo'];
            protected $casts = [
    'photo' => 'array',
];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
