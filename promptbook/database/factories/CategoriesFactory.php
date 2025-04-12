<?php

/*
    Contributor: Xander
*/
namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categories>
 */
class CategoriesFactory extends Factory
{
    protected $model = \App\Models\Categories::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'art', 'music', 'technology', 'science', 'literature', 'history', 'sports', 'travel', 'food', 'health',
            'fashion', 'education', 'business', 'finance', 'gaming', 'movies', 'photography', 'nature', 'animals',
            'relationships', 'self-improvement', 'parenting', 'home', 'gardening', 'crafts', 'hobbies', 'spirituality',
            'philosophy', 'psychology', 'politics', 'current events', 'social issues', 'environment', 'culture',
            'community', 'lifestyle', 'wellness', 'mindfulness', 'productivity', 'motivation', 'inspiration',
            'creativity', 'innovation', 'entrepreneurship', 'leadership', 'teamwork', 'communication', 'collaboration',
            'networking', 'mentorship', 'coaching', 'personal development', 'career', 'job search', 'interviewing',
            'resume writing', 'cover letters', 'professional growth', 'work-life balance', 'remote work', 'freelancing',
            'side hustles', 'passion projects', 'volunteering', 'giving back', 'charity', 'nonprofit', 'activism',
            'advocacy', 'social justice', 'human rights', 'diversity', 'inclusion', 'equity', 'accessibility',
            'sustainability', 'climate change', 'renewable energy', 'conservation', 'wildlife', 'biodiversity',
        ];

        $name = $this->faker->unique()->randomElement($categories);

        return [
            'name' => strtolower($name),
            'description' => $this->faker->sentence(),
            'icon' => $this->faker->emoji(),
            'color' => $this->faker->hexColor(),
            'slug' => Str::slug($name),
            'is_visible' => $this->faker->boolean(80),
        ];
    }
}
