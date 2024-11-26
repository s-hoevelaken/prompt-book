<?php

/*
    Contributor: Stephan
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Prompt extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'content', 'is_public'];

    /* 
        Prompt belongs to a user
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /* 
        Prompt has likes
    */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /* 
        Prompt has favourites
    */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /* 
        Promt can be liked by a user
    */
    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    /* 
        Promt can be favourited by a user
    */
    public function isFavouritedBy($userId)
    {
        return $this->favorites()->where('user_id', $userId)->exists();
    }


    /* 
        Promt can be commented on by a user
    */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /* 
        Apply filter to the query
    */
    public function scopeApplyFilter($query, $filter)
    {
        if ($filter === 'likes') {
            $query->whereHas('likes', function ($query) {
                $query->where('user_id', Auth::id());
            });
        } elseif ($filter === 'favorites') {
            $query->whereHas('favorites', function ($query) {
                $query->where('user_id', Auth::id());
            });
        }

        return $query;
    }

    /*
        Apply ordering to the query
    */
    public function scopeApplyOrdering($query, $state)
    {
        switch ($state) {
            case 'old-date':
                return $query->orderBy('created_at', 'asc');
            case 'total-likes':
                return $query->orderBy('likes', 'desc');
            default:
                return $query->orderBy('created_at', 'desc');
        }
    }
}
