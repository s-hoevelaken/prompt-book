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
        // Arrange: Create a user
        $user = User::factory()->create();

        // Assert: Check that the user exists in the database
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => $user->email,
        ]);

        // Proceed to create the prompt
        $promptData = [
            'title' => 'My First Prompt',
            'description' => '<p>This is my first prompt</p>',
            'content' => '<p>This is the content of my first prompt</p>',
            'is_public' => 1, 
        ];

        // Act: Create the prompt
        $response = $this->actingAs($user)->post(route('prompts.store'), $promptData);

        // Debugging: Log the response content to understand if there are issues
        Log::info('Prompt creation response:', [
            'status' => $response->status(),
            'content' => $response->getContent(),
        ]);

        // Assert that the prompt was successfully created in the database
        $this->assertDatabaseHas('prompts', [
            'title' => 'My First Prompt',
            'description' => '<p>This is my first prompt</p>',
            'content' => '<p>This is the content of my first prompt</p>',
            'is_public' => 1,
        ]);

        // Retrieve the created prompt from the database
        $prompt = Prompt::where('title', 'My First Prompt')->first();

        // Debugging: Check if the prompt was found
        if ($prompt === null) {
            Log::error('Prompt could not be found in the database after creation');
        }

        // Log prompt information after creation
        Log::info('Prompt created:', [
            'id' => $prompt->id ?? 'Not Found',
            'title' => $prompt->title ?? 'Not Found',
            'description' => $prompt->description ?? 'Not Found',
            'content' => $prompt->content ?? 'Not Found',
            'is_public' => $prompt->is_public ?? 'Not Found',
            'user_id' => $prompt->user_id ?? 'Not Found',
        ]);

        // Act: Delete the prompt
        $response = $this->actingAs($user)->delete(route('prompts.destroy', $prompt->id));

        // Assert: Check if the response contains the success message
        $response->assertJson(['message' => 'Prompt deleted successfully.']);

        // Log the prompt deletion attempt
        Log::info('Prompt deletion attempted for ID:', ['id' => $prompt->id]);

        // Assert: Verify the prompt is no longer in the database
        $this->assertDatabaseMissing('prompts', [
            'id' => $prompt->id,
            'title' => 'My First Prompt',
            'description' => '<p>This is my first prompt</p>',
            'content' => '<p>This is the content of my first prompt</p>',
            'is_public' => 1,
        ]);
    }

    public function test_unauthorized_user_cannot_delete_a_prompt()
    {
        $prompt = Prompt::factory()->create();

        $this->withoutMiddleware();

        $response = $this->delete(route('prompts.destroy', $prompt->id));
        $response->assertStatus(404);
    }

    public function test_unknown_user_cannot_delete_a_prompt()
    {
        $prompt = Prompt::factory()->create();
    
        $response = $this->delete(route('prompts.destroy', $prompt->id));
    
        $response->assertStatus(302);
    }
}
