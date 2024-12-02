<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'category_id', 'image', 'created_by']; // Add 'created_by'

    // Relationship to Category (optional, if needed)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by'); // 'created_by' is the foreign key in blogs table
    }
    // Blog.php (Model)
public function comments()
{
    return $this->hasMany(Comment::class);
}

}
