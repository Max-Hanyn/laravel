<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $userRoles = Auth::user()->roles->pluck('name');
        if (!$userRoles->contains($role)) {
            return redirect('/home');
        }

        return $next($request);
    }
}
