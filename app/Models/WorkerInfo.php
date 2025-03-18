<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkerInfo extends Model
{
    //
    use HasFactory;

    protected $fillable = ['user_id', 'passport_no', 'date_of_issue', 'place_of_issue', 'company_name'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
