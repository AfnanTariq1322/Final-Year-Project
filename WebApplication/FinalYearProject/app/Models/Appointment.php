<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'user_id',
        'appointment_date',
        'user_report',
        'appointment_time',
        'reason',
        'payment_receipt',
        'status'
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime:H:i',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 