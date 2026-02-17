<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticatedSessionController
{
    /**
     * Show the admin login form
     */
    public function create()
    {
        return view('admin.auth.login');
    }

    /**
     * Store a newly authenticated admin session.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($validated, $request->boolean('remember'))) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'The provided credentials are invalid.']);
        }

        $request->session()->regenerate();

        // Check if user is admin
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        // If logged in but not an admin, log them out and show error
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'You do not have admin privileges.']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
