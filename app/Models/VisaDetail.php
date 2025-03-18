<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisaDetail extends Model
{

    //
        use HasFactory;

    protected $fillable = ['user_id', 'photo', 'name', 'gender', 'passport_number', 'visa_type', 'visa_issue_date', 'visa_expire_date'];
    protected $casts = [
    'photo' => 'array',
];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
