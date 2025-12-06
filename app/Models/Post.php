<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    // Post, bir kullanıcıya aittir.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Post'un birden fazla Comment'i olabilir.
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function images()
    {
        // Bir postun çok resmi vardır
        return $this->hasMany(PostImage::class);
    }
}
