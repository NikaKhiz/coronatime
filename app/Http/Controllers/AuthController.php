<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RecoverPasswordRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\EmailVerifyRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
	public function register(RegisterRequest $request): RedirectResponse
	{
		$user = User::create([...$request->validated(), 'password' => bcrypt($request->password)]);

		event(new Registered($user));
		return redirect()->route('verification.notice');
	}

	public function verifyEmail(EmailVerifyRequest $request): View
	{
		$request->fulfill();
		return view('auth.success-email');
	}

	public function recoverPassword(RecoverPasswordRequest $request): RedirectResponse
	{
		$status = Password::sendResetLink(
			$request->only('email')
		);

		return $status === Password::RESET_LINK_SENT
					? redirect()->route('verification.notice')
					: back()->withErrors(['email' => __($status)]);
	}

	public function resetPasswordForm($token): View
	{
		return view('auth.reset-password', ['token' => $token]);
	}

	public function resetPassword(ResetPasswordRequest $request): RedirectResponse
	{
		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function (User $user, string $password) {
				$user->forceFill([
					'password' => Hash::make($password),
				])->setRememberToken(Str::random(60));

				$user->save();

				event(new PasswordReset($user));
			}
		);
		return $status === Password::PASSWORD_RESET
		? redirect()->route('view.password_reset_success')
		: back()->withErrors(['email' => [__($status)]]);
	}

	public function login(LoginRequest $request): RedirectResponse
	{
		$fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		$isUserVerified = User::firstWhere($fieldType, $request->username)['email_verified_at'] !== null;

		if (!User::firstWhere($fieldType, $request->username)) {
			throw  ValidationException::withMessages([
				'username'=> __('login/login.username'),
			]);
		}

		if ($isUserVerified) {
			if (auth()->attempt([$fieldType => $request->username, 'password' =>$request->password], $request->has('remember'))) {
				session()->regenerate();
				return redirect()->route('dashboard');
			} else {
				throw  ValidationException::withMessages([
					'username'=> __('auth.failed'),
				]);
			}
		} else {
			return redirect()->route('verification.notice');
		}
	}

	public function logout(): RedirectResponse
	{
		auth()->logout();
		return redirect()->route('view.login');
	}
}
