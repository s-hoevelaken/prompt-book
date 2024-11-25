<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // run the PromptFactory and creat 20 prompts
        \App\Models\Prompt::factory(20)->create();
        \App\Models\Comment::factory(20)->create();

        // command to run the seeder
        // php artisan db:seed --class=PromptSeeder
    }
}
