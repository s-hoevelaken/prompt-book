<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'prompt_id', 'content'];

    
    public function prompt(): BelongsTo
    {
        return $this->belongsTo(Prompt::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function isFavouritedBy($userId)
    {
        return $this->favorites()->where('user_id', $userId)->exists();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
