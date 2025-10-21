<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = []; // Basitlik için tüm alanları toplu atamaya açar

    // Yorum, bir Post'a aittir.
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    // Yorum, bir kullanıcıya aittir (yorumun sahibi).
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
