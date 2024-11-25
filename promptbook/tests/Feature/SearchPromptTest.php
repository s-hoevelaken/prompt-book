<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Prompt;

class SearchPromptTest extends TestCase
{
    use RefreshDatabase; // This will ensure each test starts with a fresh database

    /**
     * Test that a user can search for prompts by title.
     */
    public function test_user_can_search_prompts_by_title()
    {
        // Arrange: Create an authenticated user and several prompts
        $user = User::factory()->create();
        $prompt1 = Prompt::factory()->create(['title' => 'Learn Laravel Testing']);
        $prompt2 = Prompt::factory()->create(['title' => 'Learn PHP Basics']);
        $prompt3 = Prompt::factory()->create(['title' => 'Master Vue.js']);

        // Act: Search for prompts with a specific keyword
        $response = $this->actingAs($user)->get(route('search.prompts.results', ['query' => 'Learn']));

        // Assert: Check if the response is successful (e.g., 200 OK)
        $response->assertStatus(200);

        // Assert: Verify that the response contains the relevant prompts
        $response->assertSeeText('Learn Laravel Testing');
        $response->assertSeeText('Learn PHP Basics');

        // Assert: Verify that the response does not contain unrelated prompts
        $response->assertDontSeeText('Master Vue.js');
    }

    /**
     * Test that a search with no matches returns an appropriate response.
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

        // Optionally: Assert that the response contains a "no results found" message
        $response->assertSeeText('No prompts found');
    }

    /**
     * Test that an empty search query returns all prompts.
     */
    public function test_empty_search_query_returns_all_prompts()
    {
        // Arrange: Create an authenticated user and several prompts
        $user = User::factory()->create();
        $prompt1 = Prompt::factory()->create(['title' => 'Laravel Tips']);
        $prompt2 = Prompt::factory()->create(['title' => 'Vue.js Advanced Techniques']);
        $prompt3 = Prompt::factory()->create(['title' => 'PHP for Beginners']);

        // Act: Perform an empty search query
        $response = $this->actingAs($user)->get(route('search.prompts.results', ['query' => '']));

        // Assert: Check if the response is successful (e.g., 200 OK)
        $response->assertStatus(200);

        // Assert: Verify that the response contains all the prompts
        $response->assertSeeText('Laravel Tips');
        $response->assertSeeText('Vue.js Advanced Techniques');
        $response->assertSeeText('PHP for Beginners');
    }
}
