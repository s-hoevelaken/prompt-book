<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/*
    To run this test you need to run the following command:
    php artisan test --filter LoginTest
*/

class LoginTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_user_can_login_with_valid_data()
    {
        // Arrange: Create a user
        $user = User::factory()->create([
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Act: Test the Livewire component
        Livewire::test('pages.auth.login')
            ->set('form.email', 'johndoe@example.com')
            ->set('form.password', 'password123')
            ->call('login')
            ->assertRedirect(route('homepage')); 

        // Assert: Check authentication status
        $this->assertAuthenticatedAs($user);
    }
}
