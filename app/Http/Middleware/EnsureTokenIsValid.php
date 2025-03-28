<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        logger('Contenu de la session : ' . json_encode(Session::all()));
        if (!Session::has('idToken')) {
            logger('Token absent, redirection vers login');
            return redirect()->route('login')->withErrors([
                'credentials' => 'Login to access this page',
            ]);
        }
        logger('Token présent, accès autorisé');
        return $next($request);
    }
}
