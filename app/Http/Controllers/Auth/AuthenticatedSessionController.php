<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login page.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => $request->session()->get('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     //
    //     $credentials = $request->only('email', 'password');
    //     // check if the email is verified

    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect(to:'/admin');
    // }
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $userExists = User::where('email', $credentials['email'])->exists();

        if (!$userExists) {
            return back()->withErrors([
                'credentials' => "The email or password you entered doesn't match our records. Please double-check and try again.",
            ]);
        }

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // return redirect()->intended('/admin');
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'credentials' => "The email or password you entered doesn't match our records. Please double-check and try again.",
        ]);
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
