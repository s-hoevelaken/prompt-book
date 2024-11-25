<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Prompt;

class TogglePromptPublicityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the creator of the prompt can toggle its publicity.
     */
    public function test_authenticated_user_can_toggle_prompt_publicity()
    {
        $user = User::factory()->create();
        $prompt = Prompt::factory()->create(['user_id' => $user->id, 'is_public' => false]);

        $response = $this->actingAs($user)->put(route('prompts.togglePublicity', $prompt->id));

        $response->assertStatus(200);
        $this->assertDatabaseHas('prompts', [
            'id' => $prompt->id,
            'is_public' => true
        ]);
    }

    /**
     * Test that an authenticated user who is not the owner cannot toggle the publicity of the prompt.
     */
    public function test_authenticated_non_owner_cannot_toggle_prompt_publicity()
    {
        // Arrange: Create a prompt owned by user1 and another user (user2)
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $prompt = Prompt::factory()->create(['user_id' => $user1->id, 'is_public' => false]);

        // Act: Attempt to toggle publicity as user2 (not the owner)
        $response = $this->actingAs($user2)->put(route('prompts.togglePublicity', $prompt->id));

        $this->assertTrue(
            in_array($response->status(), [403, 404]),
            "Expected response status code [403 or 404] but received {$response->status()}."
        );
        $this->assertDatabaseHas('prompts', [
            'id' => $prompt->id,
            'is_public' => false
        ]);
    }

    /**
     * Test that an unauthenticated user cannot toggle the publicity of the prompt.
     */
    
    public function test_unauthenticated_user_cannot_toggle_prompt_publicity()
    {
        // Arrange: Create a prompt owned by user1
        $user1 = User::factory()->create();
        $prompt = Prompt::factory()->create(['user_id' => $user1->id, 'is_public' => false]);

        // Act: Attempt to toggle the publicity without logging in
        $response = $this->put(route('prompts.togglePublicity', $prompt->id));

        $response->assertStatus(302);

        $this->assertDatabaseHas('prompts', [
            'id' => $prompt->id,
            'is_public' => false,
        ]);
    }
}