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

    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $client = new Client();
        $apiLogin = env('API_LOGIN', "http://localhost:3000/api/auth/login");

        try {
            $response = $client->post($apiLogin, [
                'json' => [
                    'email' => $request->email,
                    'password' => $request->password,
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['idToken'])) {
                // Stocker le token dans la session avec la clé 'idToken'
                Session::put('idToken', $data['idToken']);
                Session::save();
                logger('Token après stockage : ' . Session::get('idToken'));

                $user = User::where('email', $request->email)->first();
                if (!$user) {
                    logger('Utilisateur non trouvé pour l\'email : ' . $request->email);
                    return back()->withErrors([
                        'credentials' => 'Utilisateur non trouvé.',
                    ]);
                }

                logger('Utilisateur trouvé : ' . json_encode($user->toArray()));

                try {
                    Auth::login($user);
                    logger('Utilisateur authentifié : ' . Auth::id());
                } catch (\Exception $e) {
                    logger('Erreur lors de Auth::login : ' . $e->getMessage());
                    return back()->withErrors([
                        'credentials' => 'Erreur lors de l\'authentification : ' . $e->getMessage(),
                    ]);
                }

                // Retourner une réponse JSON pour Inertia.js
                return redirect('/admin');
            } else {
                return back()->withErrors([
                    'credentials' => "The email or password you entered doesn't match our records. Please double-check and try again.",
                ]);
            }
        } catch (\Throwable $th) {
            logger('Erreur lors de l\'appel API : ' . $th->getMessage());
            return back()->withErrors([
                'credentials' => "Error: An error occurred while trying to log in. Please try again later.",
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
