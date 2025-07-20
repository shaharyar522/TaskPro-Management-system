<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */


    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // ✅ Allow admin even if status is 0
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        // ✅ Only block normal users
        if ($user->status != 1 || $user->blocked == 1) {
            Auth::logout(); // Log out immediately
            return redirect()->route('login')->with('warning', 'Your account is Pending Please wait approved by admin.');
        }

        // ✅ Role-based redirection
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('user')) {
            return redirect()->route('user.dashboard');
        }

        // Fallback if no role matched
        Auth::logout();
        return redirect()->route('login')->with('warning', 'Access denied. No role assigned.');
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
