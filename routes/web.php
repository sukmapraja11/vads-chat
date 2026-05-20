<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/workspace', [ChatController::class, 'workspace']);
    Route::get('/sd/chat/{id}', [ChatController::class, 'sdChat']);
    Route::get('/master-customer', [ChatController::class, 'masterCustomer']);
});

Route::get(
    '/register-chat',
    [ChatController::class, 'register']
);

Route::post(
    '/register-chat',
    [ChatController::class, 'registerPost']
);

Route::get(
    '/queue/{id}',
    [ChatController::class, 'queue']
);

Route::get(
    '/refresh-captcha',
    [ChatController::class, 'refreshCaptcha']
);

Route::get(
    '/check-sd/{id}',
    [ChatController::class, 'checkSD']
);

Route::get(
    '/chat/{id}',
    [ChatController::class, 'chat']
);

Route::post(
    '/save-message',
    [ChatController::class, 'saveMessage']
);

require __DIR__ . '/auth.php';
