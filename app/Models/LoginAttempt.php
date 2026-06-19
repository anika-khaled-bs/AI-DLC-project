<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

/**
 * Append-only record of authentication attempts, used for lockout computation
 * and security review. Not PHI.
 */
#[Fillable(['email', 'ip_address', 'successful', 'attempted_at'])]
class LoginAttempt extends Model
{
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'successful' => 'boolean',
            'attempted_at' => 'datetime',
        ];
    }
}
