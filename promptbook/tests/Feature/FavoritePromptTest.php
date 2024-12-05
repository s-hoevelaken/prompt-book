<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Prompt;

class FavoritePromptTest extends TestCase
{
    use RefreshDatabase;

    /*
        an authenticated user can favorite a prompt.
     */
    public function test_authenticated_user_can_favorite_a_prompt()
    {
        // Arrange: Create a user and a prompt
        $user = User::factory()->create();
        $prompt = Prompt::factory()->create();

        // Act: Send a favorite request as the authenticated user
        $response = $this->actingAs($user)->post(route('prompts.toggleFavorite', $prompt->id));

        // Assert: Check if the response is successful (e.g., 200 OK)
        $response->assertStatus(200);

        // Assert: Verify the prompt is favorited in the database
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'prompt_id' => $prompt->id,
        ]);
    }

    /*
        an unauthenticated user cannot favorite a prompt.
     */
    public function test_unauthenticated_user_cannot_favorite_a_prompt()
    {
        // Arrange: Create a prompt
        $user = User::factory()->create();
        $prompt = Prompt::factory()->create();

        // Act: Attempt to favorite the prompt without authentication
        $response = $this->post(route('prompts.toggleFavorite', $prompt->id));

        // Assert: Verify that the response status is either 401 (Unauthorized) or 302 (Redirect)
        $this->assertTrue(
            in_array($response->status(), [401, 302]),
            "Expected response status code [401 or 302] but received {$response->status()}."
        );

        // Assert: Verify the favorite is not recorded in the database
        $this->assertDatabaseMissing('favorites', [
            'prompt_id' => $prompt->id,
        ]);
    }

    /*
        an authenticated user can unfavorite a prompt they have already favorited.
     */
    public function test_authenticated_user_can_unfavorite_a_prompt()
    {
        // Arrange: Create a user and a prompt
        $user = User::factory()->create();
        $prompt = Prompt::factory()->create();

        $this->actingAs($user)->post(route('prompts.toggleFavorite', $prompt->id));

        // Assert: Verify the prompt is favorited in the database
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'prompt_id' => $prompt->id,
        ]);

        // Act: Send an unfavorite request as the authenticated user
        $response = $this->actingAs($user)->post(route('prompts.toggleFavorite', $prompt->id));

        // Assert: Check if the response is successful (e.g., 200 OK)
        $response->assertStatus(200);

        // Assert: Verify the prompt is unfavorited in the database
        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'prompt_id' => $prompt->id,
        ]);
    }
}