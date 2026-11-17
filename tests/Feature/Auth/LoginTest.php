<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'test@north.test',
            'password' => bcrypt('Password123!'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@north.test',
            'password' => 'Password123!',
        ]);

        $response->assertRedirect('/dashboard');

        $this->assertAuthenticatedAs($user);
    }


    public function test_a_user_cannot_login_with_invalid_credentials(): void
    {
        User::factory()->create([
            'email' => 'test@north.test',
            'password' => bcrypt('Password123!'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@north.test',
            'password' => 'WrongPassword123!',
        ]);

        $response->assertSessionHasErrors('email');

        $this->assertGuest();
    }

}
