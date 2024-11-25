<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Prompt;
use Illuminate\Support\Facades\Log;

class LikePromptTest extends TestCase
{
    use RefreshDatabase; // This will ensure each test starts with a fresh database

    /**
     * Test that an authenticated user can like a prompt.
     */
    public function test_authenticated_user_can_like_a_prompt()
    {
        // Arrange: Create a user and a prompt
        $user = User::factory()->create();
        $prompt = Prompt::factory()->create();

        // Act: Send a like request as the authenticated user
        $response = $this->actingAs($user)->post(route('prompts.toggleLike', $prompt->id));

        // Assert: Check if the response is successful (e.g., 200 OK)
        $response->assertStatus(200);

        // Assert: Verify the prompt is liked in the database
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'prompt_id' => $prompt->id,
        ]);
    }
    public function test_authenticated_user_can_unlike_a_prompt()
    {
        // Arrange: Create a user and a prompt, and like the prompt
        $user = User::factory()->create();
        $prompt = Prompt::factory()->create();

        // Initially like the prompt
        $this->actingAs($user)->post(route('prompts.toggleLike', $prompt->id));

        // Act: Unlike the prompt by sending the toggle request again
        $response = $this->actingAs($user)->post(route('prompts.toggleLike', $prompt->id));

        // Assert: Check if the response is successful (e.g., 200 OK)
        $response->assertStatus(200);

        // Assert: Verify the prompt is no longer liked in the database
        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'prompt_id' => $prompt->id,
        ]);
    }

    public function test_unauthenticated_user_cannot_like_a_prompt()
    {
        // Arrange: Create a prompt
        $prompt = Prompt::factory()->create();

        // Act: Attempt to like the prompt without authentication
        $response = $this->post(route('prompts.toggleLike', $prompt->id));

        // Assert: Verify a 401 Unauthorized status is returned
        $this->assertTrue(
            in_array($response->status(), [401, 302]),
            "Expected response status code [401 or 302] but received {$response->status()}."
        );

        // Assert: Verify the like is not recorded in the database
        $this->assertDatabaseMissing('likes', [
            'prompt_id' => $prompt->id,
        ]);
    }
}
