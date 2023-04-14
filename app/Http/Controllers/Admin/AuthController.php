<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\Auth\RegisterUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
	public function register(RegisterUserRequest $request)
	{
		$user = User::create($request->validated());

		event(new Registered($user));
		auth()->login($user);
		return redirect()->route('verification.notice');
	}
}
