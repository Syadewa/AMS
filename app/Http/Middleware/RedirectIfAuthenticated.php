<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                // Pengalihan dinamis berdasarkan role saat user sudah login
                if ($user->role === 'admin') {
                    return redirect('/admin/dashboard');
                } elseif ($user->role === 'manager') {
                    return redirect('/manager/dashboard');
                } elseif ($user->role === 'user') {
                    return redirect('/user/dashboard');
                }

                // Jika role tidak cocok dengan salah satu di atas, kembali ke halaman utama
                return redirect('/');
            }
        }

        return $next($request);
    }
}
