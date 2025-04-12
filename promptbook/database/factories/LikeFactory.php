<?php

/*
    Contributor: Xander
*/

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Prompt;
use App\Models\Comment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => User::inRandomOrder()->first()?->id ?? User::factory()->create()->id,
            'prompt_id' => Prompt::inRandomOrder()->first()?->id ?? Prompt::factory()->create()->id,
            'comment_id' => Comment::inRandomOrder()->first()?->id ?? Comment::factory()->create()->id,
        ];
    }
}
