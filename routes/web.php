<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'm', 'middleware' => ['auth:web']], function () {
    Route::post('/updatemobileno', [Controller::class, 'updateMobileNo'])->name('updateMobileNo');
    Route::get('/resendcode', [Controller::class, 'resendCode'])->name('resendCode');
    Route::post('/verifycode', [Controller::class, 'verifycode'])->name('verifycode');
    Route::post('/sendMessage', [SmsController::class, 'sendMessage'])->name('sendMessage');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/messages', [SmsController::class, 'ShowSmsForm'])->name('messages');
    Route::get('/log', [SmsController::class, 'log'])->name('log');


});


require __DIR__ . '/auth.php';
