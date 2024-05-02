<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LimitGuestTalkAccess;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\MessageController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::get('rooms/{roomId}/messages', [MessageController::class, 'index']);
Route::post('rooms/{roomId}/messages', [MessageController::class, 'store']);
// 会員or非会員check
Route::middleware(['auth:api', LimitGuestTalkAccess::class])->group(function () {
    // アクセス確認用
    Route::get('/', function () {
        return ['Laravel' => app()->version()];
    });
});
