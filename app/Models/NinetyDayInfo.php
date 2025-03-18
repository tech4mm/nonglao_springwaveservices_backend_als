<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NinetyDayInfo extends Model
{
    //
        use HasFactory;

    protected $fillable = ['user_id', 'photo', 'name', 'gender', 'nationality', 'issure_date', 'expire_date'];
        protected $casts = [
    'photo' => 'array',
];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
