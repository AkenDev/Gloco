<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
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
        return view('auth.inicioSesion');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'email' => ['required', 'email'], // The email field is required and must be a valid email address
            'password' => ['required'], // The password field is required
        ]);

        // Attempt to authenticate the user with the provided email and password
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            // If authentication is successful, regenerate the session ID to prevent session fixation attacks
            $request->session()->regenerate();

            // Redirect the user to the intended page or to the dashboard if no intended page is set
            return redirect()->intended('/dashboard'); // Adjust this route as needed
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.', // The credentials do not match our records
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // Adjust this route as needed

        
    }
}
