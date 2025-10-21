<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = []; // Basitlik için tüm alanları toplu atamaya açar

    // Post, bir kullanıcıya aittir.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Post'un birden fazla Comment'i olabilir.
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
