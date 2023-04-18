<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RecoverPasswordRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
	public function register(RegisterUserRequest $request): RedirectResponse
	{
		$user = User::create([...$request->validated(), 'password' => bcrypt($request->password)]);

		event(new Registered($user));
		return redirect()->route('verification.notice');
	}

	public function verifyEmail(Request $request): View
	{
		$user = User::findOrfail($request->route('id'));

		if (!hash_equals((string) $request->route('id'), (string) $user->getKey())) {
			throw new AuthorizationException;
		}
		if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
			throw new AuthorizationException;
		}
		if ($user->markEmailAsVerified()) {
			event(new Verified($request->user()));
		}
		
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

	public function login(LoginRequest $request)
	{
		$fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		if (auth()->attempt([$fieldType => $request->username, 'password' =>$request->password], $request->has('remember'))) {
			session()->regenerate();
			return redirect()->route('admin.dashboard');
		}

		throw  ValidationException::withMessages([
			'username'=> 'There is no user record with provided credentials.',
		]);
	}

	public function logout()
	{
		auth()->logout();
		return redirect('/');
	}
}
