<?php

use App\Http\Controllers\Admin\AuthController;
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
Route::middleware('guest')->group(function () {
	Route::view('/login', 'auth.login')->name('view.login');
	Route::post('/login', [AuthController::class, 'login'])->name('login_user');
	Route::view('/register', 'auth.register')->name('view.register');
	Route::post('/register', [AuthController::class, 'register'])->name('register_user');

	Route::view('/email/verify', 'auth.verify-email')->name('verification.notice');

	Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
	Route::post('/forgot-password', [AuthController::class, 'recoverPassword'])->name('password.email');

	Route::view('/reset-password', 'auth.succes-pwd')->name('view.password_reset_success');
	Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordForm'])->name('password.reset');
	Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');

Route::middleware('auth')->group(function () {
	Route::view('/admin', 'admin.dashboard')->name('admin.dashboard');
	Route::view('/admin/statistics', 'admin.statistics')->name('admin.statistics');

	Route::get('/logout', [AuthController::class, 'logout'])->name('logout_user');
});
