<?php

/*
    Contributor: Xander
*/

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prompt>
 */
class PromptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // use user_id of users that exist in the database
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->title . ' ' . $this->faker->name,
            'description' => $this->faker->paragraph,
            'content' => $this->faker->text,
            'is_public' => $this->faker->boolean,
        ];
    }
}
