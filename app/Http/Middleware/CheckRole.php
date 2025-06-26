<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            throw UnauthorizedException::notLoggedIn();
        }

        // Dapatkan roles pengguna
        $roles = is_array($role)
            ? $role
            : explode('|', $role);

        // Periksa apakah pengguna memiliki salah satu role yang diperlukan
        if (!Auth::user()->hasAnyRole($roles)) {
            throw UnauthorizedException::forRoles($roles);
        }

        return $next($request);
    }
}
