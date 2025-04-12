<?php

/*
    Contributor: Xander
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPrompt extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_prompt';

    protected $fillable = [
        'category_id',
        'prompt_id',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function prompt()
    {
        return $this->belongsTo(Prompt::class, 'prompt_id');
    }
}
