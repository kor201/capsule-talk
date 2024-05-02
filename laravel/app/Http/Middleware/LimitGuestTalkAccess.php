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
     * @param  int  $limitMinutes セッション有効期間（分）
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $limitMinutes = 10): Response
    {
        // トークンによる認証をチェック
        if (Auth::guard('api')->check() && Auth::guard('api')->user()->currentAccessToken()->name === 'login') {
            if (!$request->session()->has('expires_at')) {
                $request->session()->forget('expires_at');
            }

            return $next($request);
        }

        // 非会員のセッション時間管理
        $expiresAt = now()->addMinutes($limitMinutes);
        if (!$request->session()->has('expires_at')) {
            $request->session()->put('expires_at', $expiresAt);
        }
        if ($request->session()->get('expires_at') < now()) {
            $request->session()->forget('expires_at');
            // セッションの期限が切れていた場合の処理
            return response()->json(['message' => 'Session expired. Please login again.'], 403);
        }

        return $next($request);
    }
}
