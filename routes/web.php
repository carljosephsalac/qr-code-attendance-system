<?php

use App\Http\Controllers\UserQrCode;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginUser')->name('loginUser');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'registerUser')->name('registerUser');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::controller(UserQrCode::class)->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('/users', 'index')->name('users.index')->can('modify-user');
        Route::post('/users', 'store')->name('users.store')->can('modify-user');
        Route::get('/users/show/{user}', 'show')->name('users.show');
        Route::get('/users/user-page', 'showUserPage')->name('users.showUserPage');
    });
    Route::get('/users/in-out/{user}', 'inOut')->name('users.inOut');
});
