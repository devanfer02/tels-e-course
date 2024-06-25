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
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $authorizeUser = $this->contains("User", ...$roles);



        // Periksa apakah pengguna terotentikasi
        $user = Auth::guard('web')->user();
        if (!$user) {
            if($authorizeUser) {
                return redirect('/login');
            }
            return redirect('/auth/login');
        }

        $user = $user->load('role');

        foreach ($roles as $role) {
            if ($user->role->role_name == $role) {
                return $next($request);
            }
        }

        if($authorizeUser) {
            return redirect('/login');
        }
        return redirect('/auth/login');
    }

    public function contains($search, ...$roles): bool
    {
        foreach ($roles as $role) {

            if ($role === $search) {
                return true;
            }
        }

        return false;
    }
}
