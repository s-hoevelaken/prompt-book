<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Prompt;

class SearchPrivatePromptTest extends TestCase
{
    use RefreshDatabase; // This will ensure each test starts with a fresh database

    /**
     * Test that a user cannot search for a private prompt of another user.
     */
    public function test_user_cannot_search_private_prompt_of_another_user()
    {
        // Arrange: Create a user and a private prompt belonging to that user
        $owner = User::factory()->create();
        $privatePrompt = Prompt::factory()->create([
            'user_id' => $owner->id,
            'is_public' => false, // Private prompt
            'title' => 'Private Laravel Tutorial'
        ]);

        // Create a different user who will perform the search
        $anotherUser = User::factory()->create();

        // Act: Perform a search for the prompt title as the different user
        $response = $this->actingAs($anotherUser)->get(route('search.prompts.results', ['query' => 'Private Laravel Tutorial']));

        // Assert: The response does not contain the private prompt details
        $response->assertStatus(200);
        $response->assertDontSee('Private Laravel Tutorial');
    }

    /**
     * Test that the owner can search for their own private prompt.
     */
    public function test_owner_can_search_their_private_prompt()
    {
        $owner = User::factory()->create();
        $privatePrompt = Prompt::factory()->create([
            'user_id' => $owner->id,
            'is_public' => 0,
            'title' => "Best test prompt"
        ]);

        $response = $this->actingAs($owner)->get(route('search.prompts.results', ['query' => "Best test prompt"]));

        $response->assertStatus(200);

        $response->assertSeeText("Best test prompt");
    }
}
