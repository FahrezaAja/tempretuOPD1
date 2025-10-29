<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    
    protected $fillable = [
        'name',
        'username',
        'gmail',
        'password',
        'role',
        'otp_code',
        'otp_expires_at',
        'otp_attempts',
        'otp_last_sent_at',
        'otp_resend_count',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
        'otp_last_sent_at' => 'datetime',
    ];

   
    public function setPasswordAttribute($value)
    {
        if ($value && !password_get_info($value)['algo']) {
            $this->attributes['password'] = bcrypt($value);
        } else {
            $this->attributes['password'] = $value;
        }
    }
}
