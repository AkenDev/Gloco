<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
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
     * Handle an incoming authentication request and for API authentications
     */
    public function store(LoginRequest $request): RedirectResponse|JsonResponse
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
    
            // Generate the token for API usage
            $user = Auth::user();
            $token = $user->createToken('api_token')->plainTextToken;
    
            // Check if the request expects a JSON response (e.g., for API calls)
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Inicio de sesión exitoso.',
                    'user' => $user,
                    'token' => $token,
                ]);
            }
    
            // Otherwise, redirect to the intended page for web users
            return redirect()->intended('/dashboard'); // Adjust this route as needed
        }
    
        // If authentication fails, respond with an error
        if ($request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Las credenciales no coinciden con nuestros registros.',
            ], 401);
        }
    
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
