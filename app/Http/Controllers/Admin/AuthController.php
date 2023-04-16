<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RecoverPasswordRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
	public function register(RegisterUserRequest $request): RedirectResponse
	{
		$user = User::create($request->validated());

		event(new Registered($user));
		auth()->login($user);
		return redirect()->route('verification.notice');
	}

	public function verifyEmail(EmailVerificationRequest $request): View
	{
		$request->fulfill();
		auth()->logout();
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
}
