<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_request_a_password_reset_link(): void
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'test@north.test',
        ]);

        $response = $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        $response->assertSessionHasNoErrors();

        Notification::assertSentTo(
            $user,
            ResetPassword::class
        );
    }


    public function test_a_user_can_reset_their_password(): void
    {
        $user = User::factory()->create([
            'email' => 'test@north.test',
            'password' => bcrypt('OldPassword123!'),
        ]);

        $token = \Illuminate\Support\Facades\Password::createToken($user);

        $response = $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'NewPassword123!',
            'password_confirmation' => 'NewPassword123!',
        ]);

        $response->assertSessionHasNoErrors();

        $this->assertTrue(
            \Illuminate\Support\Facades\Hash::check(
                'NewPassword123!',
                $user->fresh()->password
            )
        );

        $this->assertFalse(
            \Illuminate\Support\Facades\Hash::check(
                'OldPassword123!',
                $user->fresh()->password
            )
        );
    }

}
