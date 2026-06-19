<?php

namespace App\Domain\Identity\Enums;

enum RoleType: string
{
    case Patient = 'patient';
    case Provider = 'provider';
    case Staff = 'staff';
    case Admin = 'admin';

    /**
     * Privileged roles (provider/staff/admin) are subject to the idle-timeout
     * session policy and, in bolt 002, MFA.
     */
    public function isPrivileged(): bool
    {
        return $this !== self::Patient;
    }
}
