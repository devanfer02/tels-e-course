<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        // Periksa apakah pengguna terotentikasi
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect('/auth/login');
        }

        $user = $user->load('role');

        foreach ($role as $roles) {
            if ($user->role->role_name == $roles) {
                // return redirect('/');
                return $next($request);
            }
        }

        return redirect('/auth/login');
    }
}
