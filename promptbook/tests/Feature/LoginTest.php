<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;


class LoginTest extends TestCase
{
    use RefreshDatabase;

    /*
        A user can login with valid data.
    */
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

    
    /*
        A user cannot login with invalid data.
    */
    #[Test]
    public function a_user_cannot_login_with_invalid_data()
    {
        // Arrange: Create a user
        $user = User::factory()->create([
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Act: Test the Livewire component with invalid email
        Livewire::test('pages.auth.login')
            ->set('form.email', 'wrongemail@example.com')
            ->set('form.password', 'password123')
            ->call('login')
            ->assertHasErrors(['form.email' => 'auth.failed']);

        // Act: Test the Livewire component with invalid password
        Livewire::test('pages.auth.login')
            ->set('form.email', 'johndoe@example.com')
            ->set('form.password', 'wrongpassword')
            ->call('login')
            ->assertHasErrors(['form.email' => 'auth.failed']);

        // Assert: Check that the user is not authenticated
        $this->assertGuest();
    }
}
