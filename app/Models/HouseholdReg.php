<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseholdReg extends Model
{
    //
    protected $fillable = [
        'user_id',
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
