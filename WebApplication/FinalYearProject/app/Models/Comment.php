<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
 
    protected $fillable = ['blog_id', 'user_id', 'comment'];

    // Define relationship with Blog
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
