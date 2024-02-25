<?php

namespace App\Http\Middleware;

use App\Exceptions\ForbiddenException;
use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = $request->header('auth', $request->header('authorization'));
        $user = User::where(['remember_token' => $auth])->first();
        if (!$user) {
            throw new ForbiddenException();
        }
        session()->put('user', $user);
        session()->put('role', Role::where(['id' => $user->role_id])->first());
        return $next($request);
    }
}
