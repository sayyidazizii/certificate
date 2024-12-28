<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'remember' => 'nullable|boolean',
        ]);

        // Attempt login
        if (Auth::attempt($request->only('username', 'password'), $request->filled('remember'))) {
            // Regenerate session to prevent session fixation
            Session::regenerate();
            // Redirect to the intended page or the dashboard
            return redirect()->intended(route('dashboard'));
        }

        // If authentication fails, redirect back with error
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
}
