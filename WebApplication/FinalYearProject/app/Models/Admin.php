<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    
 
    protected $table = 'admins';  // Specify the table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'created_by'); // 'created_by' is the foreign key in blogs table
    }
}
