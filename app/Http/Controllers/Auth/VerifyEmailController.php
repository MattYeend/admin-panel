<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Logs;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(
        EmailVerificationRequest $request
    ): RedirectResponse {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(
                route('dashboard', absolute: false).'?verified=1'
            );
        }

        if ($request->user()->markEmailAsVerified()) {
            /** @var \Illuminate\Contracts\Auth\MustVerifyEmail $user */
            $user = $request->user();
            event(new Verified($user));
        }

        Logs::log(Logs::ACTION_VERIFY_USER, [
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ], $request->user()?->id ?? null);

        return redirect()->intended(
            route('dashboard', absolute: false).'?verified=1'
        );
    }
}
