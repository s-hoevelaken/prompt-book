<?php

namespace Tests\Feature;

use App\Models\Prompt;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/*
    To run this test you need to run the following command:
    php artisan test --filter CreatePrompt
*/
class CreatePromptTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_user_can_create_a_prompt()
    {
        // Arrange: Define valid prompt data
        $prompt = [
            'title' => 'My First Prompt',
            'description' => 'This is my first prompt',
            'content' => 'This is the content of my first prompt',
            'is_public' => 1,
        ];

        // Act: Simulate the Livewire component's `create` method
        Livewire::test('pages.create')
            ->set('form.title', $prompt['title'])
            ->set('form.description', $prompt['description'])
            ->set('form.content', $prompt['content'])
            ->set('form.is_public', $prompt['is_public'])
            ->assertRedirect(route('homepage'));

        // Assert: Verify prompt creation 
        $this->assertDatabaseHas('prompts', ['title' => $prompt['title']]);
        $this->assertDatabaseHas('prompts', ['description' => $prompt['description']]);
        $this->assertDatabaseHas('prompts', ['content' => $prompt['content']]);
        $this->assertDatabaseHas('prompts', ['is_public' => $prompt['is_public']]);

        $this->assertAuthenticated();
    }
}
