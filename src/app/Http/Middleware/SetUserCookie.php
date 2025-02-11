<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetUserCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            $minutes = 60;
            $userId = Auth::id();
            $userType = Auth::user()->user_type;
            $response->withCookie(cookie('user_id', $userId, $minutes));
            $response->withCookie(cookie('user_type', $userType, $minutes));
        }

        return $response;
    }
}