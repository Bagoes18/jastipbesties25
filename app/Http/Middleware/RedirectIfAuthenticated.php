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
    // 
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // Cek apakah admin yang sudah login
            if (Auth::guard($guard)->check()) {
                // Jika guard adalah admin, arahkan ke admin dashboard
                if ($guard == 'admin') {
                    return redirect('admin/dashboard');
                }

                // Jika sudah login sebagai user biasa, arahkan ke HOME
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
