<?php

namespace App\Domain\Identity;

use App\Domain\Identity\Enums\AccountStatus;
use App\Models\LoginAttempt;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Credential verification with account-status checks and persistent lockout
 * (stories 003, 004). Wired into Fortify via Fortify::authenticateUsing().
 *
 * Returns the User on success, or null on any failure. Failures are
 * intentionally indistinguishable to the caller (generic credentials error,
 * no account enumeration — story 003).
 */
class AuthenticationService
{
    public function attempt(string $email, string $password, ?string $ip): ?User
    {
        $email = Str::lower(trim($email));

        /** @var User|null $user */
        $user = User::where('email', $email)->first();

        if ($user === null) {
            $this->record($email, $ip, false);

            return null;
        }

        // Auto-unlock once the lockout window has elapsed (story 004).
        if ($user->status === AccountStatus::Locked && ! $user->isLocked()) {
            $user->forceFill([
                'status' => AccountStatus::Active,
                'locked_until' => null,
            ])->save();
        }

        if ($user->isLocked() || $user->status === AccountStatus::Deactivated) {
            $this->record($email, $ip, false);

            return null;
        }

        if (! Hash::check($password, $user->password)) {
            $this->record($email, $ip, false);
            $this->lockIfThresholdExceeded($user, $email);

            return null;
        }

        $this->record($email, $ip, true);
        Log::info('auth.login.success', ['user_id' => $user->id, 'ip' => $ip]);

        return $user;
    }

    private function lockIfThresholdExceeded(User $user, string $email): void
    {
        $failures = LoginAttempt::query()
            ->where('email', $email)
            ->where('successful', false)
            ->where('attempted_at', '>=', now()->subMinutes(LoginThrottlePolicy::WINDOW_MINUTES))
            ->count();

        if ($failures >= LoginThrottlePolicy::MAX_FAILURES) {
            $user->forceFill([
                'status' => AccountStatus::Locked,
                'locked_until' => now()->addMinutes(LoginThrottlePolicy::LOCKOUT_MINUTES),
            ])->save();

            Log::warning('auth.account.locked', [
                'user_id' => $user->id,
                'locked_until' => $user->locked_until,
            ]);
        }
    }

    private function record(string $email, ?string $ip, bool $successful): void
    {
        LoginAttempt::create([
            'email' => $email,
            'ip_address' => $ip,
            'successful' => $successful,
            'attempted_at' => now(),
        ]);

        if (! $successful) {
            Log::warning('auth.login.failed', ['email' => $email, 'ip' => $ip]);
        }
    }
}
