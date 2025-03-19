<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkerInfo extends Model
{
    //
    use HasFactory;

    // protected $fillable = ['user_id', 'passport_no', 'date_of_issue', 'place_of_issue', 'company_name'];
    protected $fillable = [
        'user_id',
        'passport_no',
        'date_of_issue',
        'place_of_issue',
        'company_name',
        'other_name',
        'gender',
        'date_of_birth',
        'thai_phone_no',
        'myan_phone_no',
        'thai_address',
        'myan_address',
        'work_place_address'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
