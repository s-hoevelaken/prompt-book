<?php

/*
    Contributor: Xander
*/

namespace Database\Factories;

use App\Models\User;
use App\Models\Prompt;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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
            'content' => $this->faker->text(100),
        ];
    }
}
