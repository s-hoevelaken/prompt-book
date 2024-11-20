<?php

namespace Tests\Feature;

use App\Models\User;
use App\Http\Requests\EditPromptRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UpdatePromptTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_user_can_update_a_prompt(): void
    {
        // Arrange: Create a user and a prompt associated with the user
        $user = User::factory()->create();
        $prompt = $user->prompts()->create([
            'title' => 'original title',
            'description' => '<p>This is the original description</p>',
            'content' => '<p>This is the original content</p>',
        ]);

        // Define the updated data
        $updatedPromptData = [
            'title' => 'new updated title',
            'description' => '<p>This is my new prompt</p>',
            'content' => '<p>This is the content of my new prompt</p>',
        ];

        // Act: Simulate the user submitting the form to update the prompt
        $response = $this->actingAs($user)->put(route('prompts.update', $prompt->id), $updatedPromptData);

        // Assert: Check that the prompt was updated in the database
        $this->assertDatabaseHas('prompts', array_merge($updatedPromptData, [
            'id' => $prompt->id, // Ensure we are checking the correct prompt
            'user_id' => $user->id,
        ]));

        // Assert the response status is 200
        $response->assertStatus(200);
    }


    public function test_invalid_update_data_fails_validation(): void
    {
        // Arrange: Create a user and a prompt associated with the user
        $user = User::factory()->create();
        $prompt = $user->prompts()->create([
            'title' => 'valid title',
            'description' => '<p>This is a valid description</p>',
            'content' => '<p>This is valid content</p>',
        ]);

        $updatedPromptData = [
            'title' => '',
            'description' => str_repeat('b', 501),
            'content' => 'thin',
        ];

        // Act: Validate the invalid data
        $request = new EditPromptRequest();
        $validator = Validator::make($updatedPromptData, $request->rules());

        // Assert: Validation fails and errors are returned for the invalid fields
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('title', $validator->errors()->toArray());
        $this->assertArrayHasKey('description', $validator->errors()->toArray());
        $this->assertArrayHasKey('content', $validator->errors()->toArray());
    }
}
