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

    #[Test]
    public function a_user_can_login_with_valid_data()
    {
        $data = [
            'email' => 'johndoe@example.com',
            'password' => 'password123',
        ];

        Livewire::test('pages.auth.login')
            ->set('email', $data['email'])
            ->set('password', $data['password'])
            ->call('login')
            ->assertRedirect(route('homepage'));

        // Assert: Verify user creation and authentication
        $this->assertDatabaseHas('users', ['email' => $data['email']]);
        $this->assertAuthenticated();
    }
}
