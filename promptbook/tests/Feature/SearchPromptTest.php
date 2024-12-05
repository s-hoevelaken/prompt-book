<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Prompt;

class SearchPromptTest extends TestCase
{
    use RefreshDatabase;

    /*
        Test that a user can search for prompts by title.
     */
    public function test_user_can_search_prompts_by_title()
    {
        // Arrange: Create an authenticated user and several prompts, making sure they're public
        $user = User::factory()->create();
        $prompt1 = Prompt::factory()->create(['title' => 'Learn Laravel', 'is_public' => true]);
        $prompt2 = Prompt::factory()->create(['title' => 'Learn PHP', 'is_public' => true]);
        $prompt3 = Prompt::factory()->create(['title' => 'Master Vue.js', 'is_public' => true]);
    
        // Act: Search for prompts with a specific keyword
        $response = $this->actingAs($user)->get(route('search.prompts.results', ['query' => 'Learn']));
    
        // Assert: Check if the response is successful (e.g., 200 OK)
        $response->assertStatus(200);
    
        // Assert: Verify that the response contains the relevant prompts
        $response->assertSee('Learn Laravel');
        $response->assertSee('Learn PHP');
    
        // Assert: Verify that the response does not contain unrelated prompts
        $response->assertDontSeeText('Master Vue.js');
    }
    

    /*
        Test that a search with no matches returns an appropriate response.
    */
    public function test_search_with_no_matches_returns_no_results()
    {
        // Arrange: Create an authenticated user and a few prompts
        $user = User::factory()->create();
        $prompt1 = Prompt::factory()->create(['title' => 'Introduction to JavaScript']);
        $prompt2 = Prompt::factory()->create(['title' => 'Understanding APIs']);

        // Act: Search for a prompt that does not exist
        $response = $this->actingAs($user)->get(route('search.prompts.results', ['query' => 'React Native']));

        // Assert: Check if the response is successful (e.g., 200 OK)
        $response->assertStatus(200);

        // Assert: Verify that the response does not contain any matching prompts
        $response->assertDontSeeText('Introduction to JavaScript');
        $response->assertDontSeeText('Understanding APIs');

        // Assert: Verify that the response contains a "no results found" message
        $response->assertSeeText('No prompts found');
    }
}
