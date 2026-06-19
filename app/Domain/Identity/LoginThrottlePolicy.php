<?php

namespace App\Domain\Identity;

/**
 * Account-level lockout policy (story 004). Distinct from Laravel's per-minute
 * RateLimiter: this persists a lockout on the user after repeated failures
 * within a rolling window.
 */
final class LoginThrottlePolicy
{
    /** Failed attempts within the window that trigger a lockout. */
    public const MAX_FAILURES = 5;

    /** Rolling window, in minutes, over which failures are counted. */
    public const WINDOW_MINUTES = 15;

    /** How long, in minutes, an account stays locked. */
    public const LOCKOUT_MINUTES = 15;
}
