<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
 
class User extends Authenticatable  implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'acute_disease_detected',
        'email',
        'password',
      'phone', 'country', 'city', 'address',
        'otp_code',
        'otp_expires_at',
        'is_verified','image',
        'medical_history',
        'symptoms',
        'visual_acuity',
        'eye_condition',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'acute_disease_detected' => 'array',
        'medical_history' => 'array',
        'symptoms' => 'array',
        'eye_condition' => 'array'
    ];

    /**
     * Set the acute_disease_detected attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setAcuteDiseaseDetectedAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['acute_disease_detected'] = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } elseif (is_string($value)) {
            // If it's already a JSON string, validate it
            json_decode($value);
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->attributes['acute_disease_detected'] = $value;
            } else {
                throw new \InvalidArgumentException('Invalid JSON string provided for acute_disease_detected');
            }
        } else {
            $this->attributes['acute_disease_detected'] = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    }

    /**
     * Get the acute_disease_detected attribute.
     *
     * @param  string  $value
     * @return mixed
     */
    public function getAcuteDiseaseDetectedAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }
            \Log::error('JSON decode error in getAcuteDiseaseDetectedAttribute: ' . json_last_error_msg());
            return null;
        }
        
        return $value;
    }
}
