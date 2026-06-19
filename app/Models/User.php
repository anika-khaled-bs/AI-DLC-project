<?php

namespace App\Models;

use App\Domain\Identity\Enums\AccountStatus;
use App\Domain\Identity\Enums\RoleType;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'status', 'locked_until'])]
#[Hidden(['password', 'remember_token', 'two_factor_secret', 'two_factor_recovery_codes'])]
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => RoleType::class,
            'status' => AccountStatus::class,
            'locked_until' => 'datetime',
        ];
    }

    /**
     * Whether the account is currently locked (status locked and the lockout
     * window has not yet elapsed).
     */
    public function isLocked(): bool
    {
        return $this->status === AccountStatus::Locked
            && $this->locked_until !== null
            && $this->locked_until->isFuture();
    }
}
