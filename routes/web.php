<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::post('/updatemobileno', [Controller::class, 'updateMobileNo'])->middleware('auth')->name('updateMobileNo');
Route::get('/resendcode', [Controller::class, 'resendCode'])->middleware('auth')->name('resendCode');
Route::post('/verifycode', [Controller::class, 'verifycode'])->middleware('auth')->name('verifycode');

require __DIR__.'/auth.php';
