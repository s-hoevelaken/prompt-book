<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'icon',
        'color',
        'slug',
        'is_visible',
    ];

    public function prompts()
    {
        return $this->belongsToMany(Prompt::class, 'category_prompt');
    }
}
