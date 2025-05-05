<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'doctors';

    protected $fillable = [
        'name',
        'specialization',
        'sub_specialization',
        'experience_years',
        'qualifications',
        'clinic_address',
        'contact_number',
        'email',
        'password',
        'otp_code',
        'otp_expires_at',
        'is_verified',
        'map',
        'status',
        'consultation_fee',
        'bio',
        'availability',
        'profile_image',
        'bankdetails'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'otp_expires_at' => 'datetime',
        'experience_years' => 'integer',
        'consultation_fee' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
