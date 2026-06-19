<?php

namespace App\Http\Middleware;

use App\Domain\Identity\SessionPolicy;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Invalidates a privileged-role session (provider/staff/admin) after a period
 * of inactivity (story 004). Patient sessions use the default web lifetime and
 * are not subject to this idle timeout.
 */
class EnforceIdleTimeout
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user !== null && $user->role->isPrivileged()) {
            $last = $request->session()->get(SessionPolicy::LAST_ACTIVITY_KEY);
            $timeoutSeconds = SessionPolicy::PRIVILEGED_IDLE_MINUTES * 60;

            if ($last !== null && (time() - (int) $last) > $timeoutSeconds) {
                Log::info('auth.session.expired', ['user_id' => $user->id]);

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login'))
                    ->with('status', 'Your session expired due to inactivity. Please sign in again.');
            }

            $request->session()->put(SessionPolicy::LAST_ACTIVITY_KEY, time());
        }

        return $next($request);
    }
}
