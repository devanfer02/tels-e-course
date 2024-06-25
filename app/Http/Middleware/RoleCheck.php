<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    public function handle(Request $request, Closure $next, ...$role)
    {
        // Periksa apakah pengguna terotentikasi
        if (! $request->user()) {
            abort(403, 'Unauthorized.');
        }

        foreach ($role as $roles) {
            if (Auth::user()->role->role_name == $roles) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'you are unauthorize user '], 403);
    }
}
