<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Http\Controllers\PromptController;


use Illuminate\Support\Facades\Log;
use App\Models\Prompt; 


class RemovePromptTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_a_user_can_remove_a_prompt()
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', ['id' => $user->id]);

        $promptData = [
            'title' => 'My First Prompt',
            'description' => '<p>This is my first prompt</p>',
            'content' => '<p>This is the content of my first prompt</p>',
            'is_public' => 1,
        ];

        $this->actingAs($user)->post(route('prompts.store'), $promptData);

        $this->assertDatabaseHas('prompts', [
            'title' => $promptData['title'],
            'user_id' => $user->id,
        ]);

        $prompt = Prompt::where('title', 'My First Prompt')->where('user_id', $user->id)->first();
        $this->assertNotNull($prompt, 'Prompt was not found in the database.');

        $response = $this->actingAs($user)->delete(route('prompts.destroy', $prompt->id));

        $response->assertJson(['message' => 'Prompt deleted successfully.']);

        $this->assertDatabaseMissing('prompts', ['id' => $prompt->id]);
    }



    public function test_unauthorized_user_cannot_delete_a_prompt()
    {
        $prompt = Prompt::factory()->create();

        $this->withoutMiddleware();

        $response = $this->delete(route('prompts.destroy', $prompt->id));
        $response->assertStatus(403); // Change to 403 since the controller returns 403 for unauthorized access
    }

    public function test_unknown_user_cannot_delete_a_prompt()
    {
        $prompt = Prompt::factory()->create();
    
        $response = $this->delete(route('prompts.destroy', $prompt->id));
    
        $response->assertStatus(302);
    }
}
