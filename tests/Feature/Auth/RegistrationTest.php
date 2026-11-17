<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@north.test',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $response->assertRedirect('/dashboard');

        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@north.test',
        ]);

        $this->assertEquals(
            1,
            User::where('email', 'test@north.test')->count()
        );
    }
}
