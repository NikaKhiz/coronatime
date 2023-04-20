<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class AuthService
{
	public function verify(Request $request): void
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
	}

	public function isUserVerified($fieldType, $username): bool
	{
		return User::firstWhere($fieldType, $username)['email_verified_at'] !== null;
	}
}
