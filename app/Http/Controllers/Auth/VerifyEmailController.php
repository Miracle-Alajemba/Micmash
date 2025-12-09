<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request, $id, $hash): RedirectResponse
    {
        // 1. Find the user by the ID in the URL
        $user = User::find($id);

        if (! $user) {
            return redirect()->route('login')->withErrors(['email' => 'Invalid verification link.']);
        }

        //  Check if the hash matches (Security check)
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification link.');
        }

        //  Mark as verified if not already done
        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        // Send them to the dashboard
        return redirect()->route('login')->with('status', 'Email verified successfully! Please log in.');
    }
}
