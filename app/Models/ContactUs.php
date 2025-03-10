<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactUs extends Model
{
    //
        use HasFactory;

    // ✅ Add contact_phone to allow mass assignment
    protected $fillable = ['contact_phone'];
}
