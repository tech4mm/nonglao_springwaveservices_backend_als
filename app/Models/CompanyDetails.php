<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetails extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'application_details',
        'company_address',
        'company_bank_details',
        'bank_payment_qr',
    ];

    public function getBankPaymentQrUrlAttribute(): ?string
    {
        return $this->bank_payment_qr ? Storage::url($this->bank_payment_qr) : null;
    }
}
