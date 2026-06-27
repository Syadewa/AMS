<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SingleDeviceSession
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user instanceof User) {

            if (

                session('session_token')
                !=
                $user->session_token

            ) {

                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect('/login')
                    ->withErrors([
                        'email' =>
                        'Akun ini telah digunakan pada perangkat lain.'
                    ]);
            }

        }

        return $next($request);
    }
}
