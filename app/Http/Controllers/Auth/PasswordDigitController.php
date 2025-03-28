<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rules;
use Inertia\Response;

class PasswordDigitController extends Controller
{
    //
    public function create(Request $request): Response
    {
        return Inertia::render('auth/ResetPasswordDigit', [
            'status' => $request->session()->get('status'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'digits' => 'required|numeric',
            // 'email' => 'required|email',
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // dd($request->get('digits'));
        return redirect()->intended(route('password.index'));
    }
}
