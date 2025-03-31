<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // protected $fillable = [
    //     'name',
    //     'phone',
    //     'email',
    //     'password',
    // ];
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'otp_code',
        'user_picture',
        'passport_number',
        'gender',
        'date_of_birth',
        'registration_number',
        'uid_number',
        'taxpayer_number',
        'owic_number',
        'tax_payer_number',
        'status',
    ];
    // public function getUserPictureAttribute($value){
    //     return $value ? 'storage/' . $value : null;
    // }

    // my modi code
    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->email, '@gmail.com') && $this->hasVerifiedEmail();
    }

    // end my code
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function workerInfo()
    {
        return $this->hasOne(WorkerInfo::class);
    }

    public function passportDetail()
{
    return $this->hasOne(PassportDetail::class);
}

public function visaDetail()
{
    return $this->hasOne(VisaDetail::class);
}

public function workPermitDetail()
{
    return $this->hasOne(WorkPermitDetail::class);
}

public function ninetyDayInfo()
{
    return $this->hasOne(NinetyDayInfo::class);
}

    public function passport()
{
    return $this->hasOne(\App\Models\PassportDetail::class);
}

public function visa()
{
    return $this->hasOne(\App\Models\VisaDetail::class);
}

public function workPermit()
{
    return $this->hasOne(\App\Models\WorkPermitDetail::class);
}

public function ninetyDay()
{
    return $this->hasOne(\App\Models\NinetyDayInfo::class);
}

}
