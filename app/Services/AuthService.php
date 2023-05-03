<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
	public function isUserVerified($fieldType, $username): bool
	{
		return User::firstWhere($fieldType, $username)['email_verified_at'] !== null;
	}
}
