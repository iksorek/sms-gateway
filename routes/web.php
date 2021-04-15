<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'm', 'middleware' => ['auth:web']], function () {
    Route::post('/updatemobileno', [Controller::class, 'updateMobileNo'])->name('updateMobileNo');
    Route::get('/resendcode', [Controller::class, 'resendCode'])->name('resendCode');
    Route::post('/verifycode', [Controller::class, 'verifycode'])->name('verifycode');
    Route::post('/sendMessage', [Controller::class, 'sendMessage'])->name('sendMessage');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/messages', function () {

        if (Auth::user()->mobile && Auth::user()->mobile_verified_at) {
            return view('messages');
        } else {
           return Redirect::route('dashboard')->with('info', 'Your account is not active yet.');
        }

    })->name('messages');


});


require __DIR__ . '/auth.php';
