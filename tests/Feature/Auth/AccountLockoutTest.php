<?php

namespace Tests\Feature\Auth;

use App\Domain\Identity\AuthenticationService;
use App\Domain\Identity\Enums\AccountStatus;
use App\Domain\Identity\LoginThrottlePolicy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountLockoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_account_locks_after_max_failures_and_auto_unlocks_after_window(): void
    {
        $user = User::factory()->create(['email' => 'l@example.com']); // password: "password"
        $service = app(AuthenticationService::class);

        for ($i = 0; $i < LoginThrottlePolicy::MAX_FAILURES; $i++) {
            $this->assertNull($service->attempt('l@example.com', 'wrong-password', '127.0.0.1'));
        }

        $user->refresh();
        $this->assertSame(AccountStatus::Locked, $user->status);
        $this->assertTrue($user->isLocked());

        // Even the correct password fails while locked.
        $this->assertNull($service->attempt('l@example.com', 'password', '127.0.0.1'));

        // Once the lockout window elapses, the correct password succeeds.
        $this->travel(LoginThrottlePolicy::LOCKOUT_MINUTES + 1)->minutes();
        $result = $service->attempt('l@example.com', 'password', '127.0.0.1');

        $this->assertNotNull($result);
        $this->assertSame($user->id, $result->id);
        $user->refresh();
        $this->assertSame(AccountStatus::Active, $user->status);
    }

    public function test_five_failed_logins_via_endpoint_lock_the_account(): void
    {
        $user = User::factory()->create(['email' => 'h@example.com']);

        for ($i = 0; $i < LoginThrottlePolicy::MAX_FAILURES; $i++) {
            $this->post('/login', ['email' => 'h@example.com', 'password' => 'wrong-password']);
        }

        $user->refresh();
        $this->assertSame(AccountStatus::Locked, $user->status);
    }
}
