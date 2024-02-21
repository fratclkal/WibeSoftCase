<?php

namespace App\Http\Middleware;

use App\Models\TokenModel;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthenticateToken
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
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = User::where('token', $token)->first();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->merge(['token' => $user->role]);

        return $next($request);
    }
}
