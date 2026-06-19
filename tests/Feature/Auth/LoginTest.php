<?php

namespace Tests\Feature\Auth;

use App\Domain\Identity\Enums\AccountStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create(['email' => 'a@example.com']); // factory password: "password"

        $this->post('/login', [
            'email' => 'a@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    public function test_wrong_password_fails(): void
    {
        User::factory()->create(['email' => 'a@example.com']);

        $response = $this->from('/login')->post('/login', [
            'email' => 'a@example.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    public function test_login_does_not_leak_whether_an_account_exists(): void
    {
        User::factory()->create(['email' => 'a@example.com']);

        // Both a wrong password on a real account and an unknown email must
        // yield the SAME generic error => no account enumeration (story 003).
        $generic = trans('auth.failed');

        $this->from('/login')->post('/login', [
            'email' => 'a@example.com',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors(['email' => $generic]);

        $this->from('/login')->post('/login', [
            'email' => 'nobody@example.com',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors(['email' => $generic]);

        $this->assertGuest();
    }

    public function test_deactivated_user_cannot_login(): void
    {
        User::factory()->create([
            'email' => 'gone@example.com',
            'status' => AccountStatus::Deactivated,
        ]);

        $this->from('/login')->post('/login', [
            'email' => 'gone@example.com',
            'password' => 'password',
        ]);

        $this->assertGuest();
    }
}
