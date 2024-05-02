<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LimitGuestTalkAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // トークンによる認証をチェック
        if (!Auth::guard('api')->check() || Auth::guard('api')->user()->currentAccessToken()->name !== 'login') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
