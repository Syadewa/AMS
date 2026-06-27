<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

        if ($user instanceof User) {

            $token = Str::random(60);

            $user->update([

                'session_token' => $token,

            ]);

            session([

                'session_token' => $token,

            ]);

        }

        if ($user instanceof User && $user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        } 
        elseif ($user instanceof User && $user->role === 'user') {
            return redirect()->intended('/user/dashboard');
        } 
        elseif ($user instanceof User && $user->role === 'manager') {
            return redirect()->intended('/manager/dashboard');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {   
        $user = Auth::user();

        if ($user instanceof User) {

            $user->update([

                'session_token' => null,

            ]);

        }
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
