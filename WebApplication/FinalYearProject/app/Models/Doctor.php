<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'doctors';

    protected $fillable = [
        'name',
        'email',
        'password',
        'otp_code',
        'otp_expires_at',
        'is_verified',
        'status',
        'specialization',
        'sub_specialization',
        'experience_years',
        'qualifications',
        'clinic_address',
        'contact_number',
        'consultation_fee',
        'bio',
        'profile_image',
        'availability',
        'bankdetails',
        'map'
    ];

    protected $hidden = [
        'password',
        'otp_code',
        'remember_token'
    ];

    protected $attributes = [
        'is_verified' => 0,
        'status' => 'inactive'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'otp_expires_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'availability' => 'json',
        'bankdetails' => 'json'
    ];
}
