<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Session\Middleware\StartSession;
use App\Http\Middleware\LimitGuestTalkAccess;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Chat\ChatController;

// アクセス確認用
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// 会員or非会員check
Route::middleware([StartSession::class, LimitGuestTalkAccess::class])->group(function () {
    Route::get('/chat', [ChatController::class, 'chat']);
});
