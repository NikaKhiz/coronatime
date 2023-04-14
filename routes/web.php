<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
	Route::view('/register', 'auth.register')->name('view.register');
	Route::view('/password-reset', 'auth.reset')->name('view.password_reset');

	Route::post('/register', [AuthController::class, 'register'])->name('register_user');
});


Route::view('/email/verify', 'auth.verify-email')->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	$request->fulfill();
	auth()->logout();
	return view('auth.success-email');
})->middleware(['auth', 'signed'])->name('verification.verify');
