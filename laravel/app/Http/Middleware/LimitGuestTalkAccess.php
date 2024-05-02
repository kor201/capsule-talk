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
            // トークンの有効期限をチェック（仮にトークンの有効期限をチェックする方法）
            $token = Auth::guard('api')->user()->currentAccessToken();
            if ($token->created_at->lt(now()->subMinutes($limitMinutes))) {
                // トークンの期限が切れていた場合の処理
                $token->delete();  // トークンを削除
                return response()->json(['message' => 'Session expired. Please login again.'], 403);
            }
            return $next($request);
        }

        // 認証されていない場合
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
