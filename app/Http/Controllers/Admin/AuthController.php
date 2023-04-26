<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RecoverPasswordRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
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

	public function verifyEmail(Request $request, AuthService $authservice): View
	{
		$authservice->verify($request);
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

	public function resetPasswordForm($token)
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

	public function login(LoginRequest $request, AuthService $authService): RedirectResponse
	{
		$fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		if (!User::firstWhere($fieldType, $request->username)) {
			throw  ValidationException::withMessages([
				'username'=> __('login/login.username'),
			]);
		}

		if ($authService->isUserVerified($fieldType, $request->username)) {
			if (auth()->attempt([$fieldType => $request->username, 'password' =>$request->password], $request->has('remember'))) {
				session()->regenerate();
				return redirect()->route('admin.dashboard');
			} else {
				throw  ValidationException::withMessages([
					'username'=> __('auth.failed'),
				]);
			}
		} else {
			return redirect()->route('verification.notice');
		}
	}

	public function logout()
	{
		auth()->logout();
		return redirect('/');
	}
}
