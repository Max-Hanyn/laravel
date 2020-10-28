<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class   CurrentProfile
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $userId = Auth::id();
        $userRoles = Auth::user()->roles->pluck('name');
        if ($request->route('id') == $userId || $userRoles->contains('admin') || $userRoles->contains('moderator')) {

            return $next($request);

        }
        abort(404);

    }
}
