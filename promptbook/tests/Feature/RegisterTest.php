<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;


class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /*
        A user can register with valid data.
    */
    #[Test]
    public function a_user_can_register_with_valid_data()
    {
        // Arrange: Define valid user data
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];


        // Act: Simulate the Livewire component's `register` method
        Livewire::test('pages.auth.register')
            ->set('name', $data['name'])
            ->set('email', $data['email'])
            ->set('password', $data['password'])
            ->set('password_confirmation', $data['password_confirmation'])
            ->call('register')
            ->assertRedirect(route('homepage'));


        // Assert: Verify user creation and authentication
        $this->assertDatabaseHas('users', ['email' => $data['email']]);
        $this->assertAuthenticated();
    }
}
