<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\StatisticController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', 'login');
Route::middleware('guest')->controller(AuthController::class)->group(function () {
	Route::post('/login', 'login')->name('login_user');
	Route::post('/register', 'register')->name('register_user');
	Route::post('/forgot-password', 'recoverPassword')->name('recover_password');
	Route::get('/reset-password/{token}', 'resetPasswordForm')->name('view.reset_password');
	Route::post('/reset-password', 'resetPassword')->name('reset_password');
	Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->middleware('signed')->name('verification.verify');

	Route::view('/login', 'auth.login')->name('view.login');
	Route::view('/register', 'auth.register')->name('view.register');
	Route::view('/email/verify', 'auth.verify-email')->name('verification.notice');
	Route::view('/forgot-password', 'auth.forgot-password')->name('view.forgot_password');
	Route::view('/reset-password', 'auth.succes-pwd')->name('view.password_reset_success');
});

Route::middleware('auth')->group(function () {
	Route::controller(StatisticController::class)->group(function () {
		Route::get('/dashboard', 'show')->name('dashboard');
		Route::get('/statistics', 'index')->name('statistics');
	});

	Route::get('/logout', [AuthController::class, 'logout'])->name('logout_user');
});

Route::Get('/language/{locale}', [LanguageController::class, 'changeLanguage'])->name('change_language');
