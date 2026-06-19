<?php

namespace Tests\Feature\Auth;

use App\Domain\Identity\Enums\RoleType;
use App\Domain\Identity\SessionPolicy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class IdleTimeoutTest extends TestCase
{
    use RefreshDatabase;

    private function defineProtectedRoute(): void
    {
        Route::middleware(['web', 'auth', 'idle.timeout'])
            ->get('/_test/idle', fn () => response('ok'));
    }

    public function test_privileged_session_expires_after_idle_period(): void
    {
        $this->defineProtectedRoute();
        $provider = User::factory()->role(RoleType::Provider)->create();

        $response = $this->actingAs($provider)
            ->withSession([
                SessionPolicy::LAST_ACTIVITY_KEY => now()->subMinutes(SessionPolicy::PRIVILEGED_IDLE_MINUTES + 5)->getTimestamp(),
            ])
            ->get('/_test/idle');

        $response->assertRedirect(route('login'));
    }

    public function test_active_privileged_session_is_allowed(): void
    {
        $this->defineProtectedRoute();
        $provider = User::factory()->role(RoleType::Provider)->create();

        $response = $this->actingAs($provider)
            ->withSession([SessionPolicy::LAST_ACTIVITY_KEY => now()->getTimestamp()])
            ->get('/_test/idle');

        $response->assertOk();
    }

    public function test_patient_is_not_subject_to_idle_timeout(): void
    {
        $this->defineProtectedRoute();
        $patient = User::factory()->create(); // role: patient

        $response = $this->actingAs($patient)
            ->withSession([
                SessionPolicy::LAST_ACTIVITY_KEY => now()->subMinutes(60)->getTimestamp(),
            ])
            ->get('/_test/idle');

        $response->assertOk();
    }
}
