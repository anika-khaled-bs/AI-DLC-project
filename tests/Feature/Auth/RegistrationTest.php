<?php

namespace Tests\Feature\Auth;

use App\Domain\Identity\Enums\AccountStatus;
use App\Domain\Identity\Enums\RoleType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_can_self_register_as_active_but_unverified(): void
    {
        $this->post('/register', [
            'name' => 'Pat Patient',
            'email' => 'pat@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'pat@example.com',
            'role' => 'patient',
            'status' => 'active',
        ]);

        $user = User::where('email', 'pat@example.com')->first();
        $this->assertNotNull($user);
        $this->assertSame(RoleType::Patient, $user->role);
        $this->assertSame(AccountStatus::Active, $user->status);
        // Unverified until the email link is confirmed (story 001/002).
        $this->assertNull($user->email_verified_at);
    }

    public function test_password_below_minimum_length_is_rejected(): void
    {
        $response = $this->from('/register')->post('/register', [
            'name' => 'Pat',
            'email' => 'short@example.com',
            'password' => 'short',
            'password_confirmation' => 'short',
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertDatabaseMissing('users', ['email' => 'short@example.com']);
    }

    public function test_duplicate_email_is_rejected(): void
    {
        User::factory()->create(['email' => 'dup@example.com']);

        $response = $this->from('/register')->post('/register', [
            'name' => 'Other Person',
            'email' => 'dup@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertSame(1, User::where('email', 'dup@example.com')->count());
    }
}
