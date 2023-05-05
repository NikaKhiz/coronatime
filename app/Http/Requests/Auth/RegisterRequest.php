<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
	 */
	public function rules(): array
	{
		return [
			'username'              => 'required|min:3|max:255|unique:users,username',
			'email'                 => 'required|email|unique:users,email',
			'password'              => 'required|min:3|max:255|confirmed',
			'password_confirmation' => 'required|same:password',
		];
	}
}
