<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
	use RefreshDatabase;

	public function test_password_submit_page_is_accessible()
	{
		$response = $this->get(route('view.forgot_password'));
		$response->assertSuccessful();
		$response->assertViewIs('auth.forgot-password');
	}

	public function test_password_submit_should_return_an_error_if_inputs_is_are_provided()
	{
		$response = $this->post(route('recover_password'));
		$response->assertSessionHasErrors('email');
	}

	public function test_password_submit_should_return_an_error_if_provided_email_is_invalid()
	{
		$email = 'johndoeexample.com';

		$response = $this->post(route('recover_password'), [
			'email' => $email,
		]);
		$response->assertSessionHasErrors('email');
	}

	public function test_password_submit_should_return_an_error_if_there_is_no_user_record_with_provided_email()
	{
		$email = 'johndoe@example.com';

		$response = $this->post(route('recover_password'), [
			'email' => $email,
		]);
		$response->assertSessionHasErrors('email');
	}

	public function test_password_submit_should_send_reset_link_to_user_registered_with_provided_email()
	{
		Notification::fake(ResetPassword::class);

		$user = User::factory()->create();
		$response = $this->post(route('recover_password'), ['email' => $user->email]);
		$response->assertRedirect(route('verification.notice'));

		Notification::assertSentTo(
			$user,
			ResetPassword::class,
			function ($notification, $channels) use ($user) {
				$mailMessage = $notification->toMail($user);
				$view = $mailMessage->viewData;
				$url = $view['url'];
				return $url === route('view.reset_password', $notification->token) . '?email=' . $user->getEmailForPasswordReset();
			}
		);
	}

	public function test_password_reset_page_is_accessible()
	{
		$user = User::factory()->create();

		$token = Password::createToken($user);

		$this
		->get(route('view.reset_password', ['token' => $token]))
		->assertViewIs('auth.reset-password')
		->assertSuccessful();
	}

	public function test_password_reset_page_should_return_an_errors_if_no_inputs_provided()
	{
		$user = User::factory()->create([
			'email'    => 'johndoe@example.com',
		]);
		$token = Password::createToken($user);

		$response = $this->post(route('reset_password', ['token' => $token]), [
			'email' => $user->email,
		]);
		$response->assertSessionHasErrors([
			'password', 'password_confirmation',
		]);
	}

	public function test_password_reset_page_should_return_an_errors_if_provided_password_is_less_than_three_characters()
	{
		$user = User::factory()->create([
			'email'    => 'johndoe@example.com',
		]);
		$token = Password::createToken($user);

		$response = $this->post(route('reset_password', ['token' => $token]), [
			'email'   => $user->email,
			'password'=> 'ps',
		]);
		$response->assertSessionHasErrors([
			'password', 'password_confirmation',
		]);
	}

	public function test_password_reset_page_should_return_an_errors_if_password_confirmation_doesnt_match_to_password()
	{
		$user = User::factory()->create([
			'email'    => 'johndoe@example.com',
		]);
		$token = Password::createToken($user);

		$response = $this->post(route('reset_password', ['token' => $token]), [
			'email'                 => $user->email,
			'password'              => 'password',
			'password_confirmation' => 'pasword',
		]);
		$response->assertSessionHasErrors([
			'password', 'password_confirmation',
		]);
	}

public function test_password_reset_page_should_update_password_for_current_user_if_he_provides_correct_information()
{
	Event::fake(PasswordReset::class);

	$user = User::factory()->create([
		'email'    => 'johndoe@example.com',
	]);
	$token = Password::createToken($user);

	$response = $this->post(route('reset_password', ['token' => $token]), [
		'email'                 => $user->email,
		'password'              => 'password',
		'password_confirmation' => 'password',
	]);
	$response->assertRedirect(route('reset_password'));

	Event::assertDispatched(PasswordReset::class);
}
}
