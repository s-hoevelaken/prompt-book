<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\StorePromptRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class CreatePromptTest extends TestCase
{
    use RefreshDatabase;

    /*
        A user can create a prompt with valid data
    */
    public function test_a_user_can_create_a_prompt()
    {
        // Arrange: Create a user and define valid prompt data
        $user = User::factory()->create();
        $promptData = [
            'title' => 'My First Prompt',
            'description' => '<p>This is my first prompt</p>',
            'content' => '<p>This is the content of my first prompt</p>',
            'is_public' => 1, 
        ];

        // Act: Simulate the user submitting the form to create a prompt
        $response = $this->actingAs($user)->post(route('prompts.store'), $promptData);
    

        // Assert: Check that the prompt was created and the user was redirected
        $response->assertRedirect(route('homepage'));
        $this->assertDatabaseHas('prompts', [
            'title' => 'My First Prompt',
            'description' => '<p>This is my first prompt</p>',
            'content' => '<p>This is the content of my first prompt</p>',
            'is_public' => 1,
            'user_id' => $user->id,
        ]);
    }


    /*
        A user can not create a prompt with invalid data
    */
    public function test_invalid_data_fails_validation()
    {
        // Arrange: Define invalid prompt data
        $data = [
            'title' => '',
            'description' => str_repeat('a', 501), 
            'content' => 'short', 
            'is_public' => 'not_boolean',
        ];

        // Act: Simulate the user submitting the form to create a prompt
        $request = new StorePromptRequest();
        $validator = Validator::make($data, $request->rules());

        // Assert: Check that the prompt was created and the user was redirected
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('title', $validator->errors()->toArray());
        $this->assertArrayHasKey('description', $validator->errors()->toArray());
        $this->assertArrayHasKey('content', $validator->errors()->toArray());
        $this->assertArrayHasKey('is_public', $validator->errors()->toArray());
    }
}