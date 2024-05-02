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
// Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::get('/chat', [ChatController::class, 'chat'])->middleware([StartSession::class, LimitGuestTalkAccess::class]);