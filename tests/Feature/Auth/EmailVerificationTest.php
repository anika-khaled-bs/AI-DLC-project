<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_signed_link_marks_email_verified(): void
    {
        $user = User::factory()->unverified()->create();
        $this->assertNull($user->email_verified_at);

        $url = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), [
            'id' => $user->id,
            'hash' => sha1($user->getEmailForVerification()),
        ]);

        $this->actingAs($user)->get($url);

        $user->refresh();
        $this->assertNotNull($user->email_verified_at);
    }

    public function test_invalid_hash_does_not_verify(): void
    {
        $user = User::factory()->unverified()->create();

        $url = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), [
            'id' => $user->id,
            'hash' => sha1('someone-else@example.com'),
        ]);

        $this->actingAs($user)->get($url);

        $user->refresh();
        $this->assertNull($user->email_verified_at);
    }
}
