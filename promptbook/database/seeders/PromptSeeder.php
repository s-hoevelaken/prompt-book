<?php

/*
    Contributor: Xander
*/

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
        \App\Models\User::factory(40)->create();
        \App\Models\Prompt::factory(40)->create();
        \App\Models\Comment::factory(40)->create();

        \App\Models\Like::factory(80)->create();
        \App\Models\Favorite::factory(80)->create();

        // php artisan db:seed --class=PromptSeeder
    }
}
