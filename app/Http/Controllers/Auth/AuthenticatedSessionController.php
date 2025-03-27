<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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
        $client = new Client();
        $apiLogin = env('API_LOGIN', 'http://localhost:3000/api/auth/login');
        // $userExists = User::where('email', $credentials['email'])->exists();
        try {
            $response = $client->post($apiLogin, [
                'json' => [
                    'email' => $credentials['email'],
                    'password' => $credentials['password']
                ]
            ]);
            // dd($response);
            // Decode the response Json
            $data = json_decode($response->getBody()->getContents(), true);
            // dd($data);
            if(isset($data['idToken'])){
                // Save the idToken in the session
                Session::put('idToken', $data['idToken']);
                logger('Token après stockage : ' . Session::get('idToken'));
                // dd(Session::get('idToken'));
                $request->session()->regenerate();
                logger('Token après appress dfs stockage : ' . Session::get('idToken'));

                // redirect to the admin dashboard
                return redirect(to:'/admin');
                // return redirect()->intended(route('filament.admin.pages.dashboard'));
            }
            return back()->withErrors([
                'credentials' => "The email or password you entered doesn't match our records. Please double-check and try again.",
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withErrors([
                'credentials' => "The email or password you entered doesn't match our records. Please double-check and try again.",
            ]);
        }


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
