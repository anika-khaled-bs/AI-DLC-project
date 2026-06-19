<?php

namespace App\Domain\Identity;

/**
 * Session idle-timeout policy (story 004). Privileged roles (provider/staff/admin)
 * are invalidated after a period of inactivity; patients use the default web
 * session lifetime.
 */
final class SessionPolicy
{
    /** Idle timeout, in minutes, for privileged roles. */
    public const PRIVILEGED_IDLE_MINUTES = 15;

    /** Session key holding the unix timestamp of the last activity. */
    public const LAST_ACTIVITY_KEY = 'last_activity_at';
}
