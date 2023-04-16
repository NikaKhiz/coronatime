<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
	 */
	public function rules(): array
	{
		return [
			'email'                 => 'required|email',
			'token'                 => 'required',
			'password'              => 'required|min:3|confirmed',
			'password_confirmation' => 'required|same:password',
		];
	}
}
