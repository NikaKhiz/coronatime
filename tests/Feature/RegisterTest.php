<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RegisterTest extends TestCase
{
	use RefreshDatabase;

	public function test_register_page_is_accessible()
	{
		$response = $this->get('/register');
		$response->assertSuccessful();
		$response->assertViewIs('auth.register');
	}

	public function test_register_should_give_us_an_errors_if_no_inputs_provided()
	{
		$response = $this->post('/register');
		$response->assertSessionHasErrors([
			'username',
			'email',
			'password',
			'password_confirmation',
		]);
	}

	public function test_register_should_give_us_an_error_if_user_doesnt_provide_username()
	{
		$response = $this->post('/register', ['email' => 'johndoe@example.com', 'password'=>'password', 'password_confirmation'=>'password']);
		$response->assertSessionHasErrors([
			'username',
		]);
		$response->assertSessionDoesntHaveErrors(['email', 'password', 'password_confirmation']);
	}

	public function test_register_should_give_us_an_error_if_user_doesnt_provide_valid_email()
	{
		$response = $this->post('/register', ['username'=>'johndoe', 'email' => 'johndoeexample.com', 'password'=>'password', 'password_confirmation'=>'password']);
		$response->assertSessionHasErrors([
			'email',
		]);
		$response->assertSessionDoesntHaveErrors(['username', 'password', 'password_confirmation']);
	}

	public function test_register_should_give_us_an_error_if_user_doesnt_provide_password()
	{
		$response = $this->post('/register', ['username'=>'johndoe', 'email' => 'johndoe@example.com', 'password_confirmation'=>'password']);
		$response->assertSessionHasErrors([
			'password', 'password_confirmation',
		]);
		$response->assertSessionDoesntHaveErrors(['username', 'email']);
	}

	public function test_register_should_give_us_an_error_if_user_doesnt_provide_password_confirmation()
	{
		$response = $this->post('/register', ['username'=>'johndoe', 'email' => 'johndoe@example.com', 'password'=>'password']);
		$response->assertSessionHasErrors([
			'password', 'password_confirmation',
		]);
		$response->assertSessionDoesntHaveErrors(['username', 'email']);
	}

	public function test_register_should_give_us_an_error_if_provided_username_is_less_than_three_characters()
	{
		$response = $this->post('/register', ['username'=>'jo', 'email' => 'johndoe@example.com', 'password'=>'password', 'password_confirmation'=>'password']);
		$response->assertSessionHasErrors([
			'username',
		]);
		$response->assertSessionDoesntHaveErrors(['email', 'password', 'password_confirmation']);
	}

	public function test_register_should_give_us_an_error_if_provided_password_is_less_than_three_characters()
	{
		$response = $this->post('/register', ['username'=>'johndoe', 'email' => 'johndoe@example.com', 'password' => 'ps', 'password_confirmation'=>'password']);
		$response->assertSessionHasErrors([
			'password', 'password_confirmation',
		]);
		$response->assertSessionDoesntHaveErrors(['username', 'email']);
	}

	public function test_register_should_give_us_an_error_if_password_confirmation_doesnt_match_to_password()
	{
		$response = $this->post('/register', ['username'=>'johndoe', 'email' => 'johndoe@example.com', 'password'=>'password', 'password_confirmation' => 'pasword']);
		$response->assertSessionHasErrors([
			'password', 'password_confirmation',
		]);
		$response->assertSessionDoesntHaveErrors(['username', 'email']);
	}

	public function test_register_should_give_us_an_error_if_provided_username_has_already_been_taken()
	{
		User::factory()->create(['username' => 'johndoe']);

		$response = $this->post('/register', ['username'=>'johndoe', 'email' => 'johndoe@example.com', 'password'=>'password', 'password_confirmation' => 'password']);
		$response->assertSessionHasErrors(['username']);
		$response->assertSessionDoesntHaveErrors(['email', 'password', 'password_confirmation']);
	}

	public function test_register_should_give_us_an_error_if_provided_email_has_already_been_taken()
	{
		User::factory()->create(['email' => 'johndoe@example.com']);

		$response = $this->post('/register', ['username'=>'johndoe', 'email' => 'johndoe@example.com', 'password'=>'password', 'password_confirmation' => 'password']);
		$response->assertSessionHasErrors(['email']);
		$response->assertSessionDoesntHaveErrors(['username', 'password', 'password_confirmation']);
	}

	public function test_register_should_create_new_user_if_provided_inputs_are_correct()
	{
		$data = [
			'username'              => 'johndoe',
			'email'                 => 'johndoe@example.com',
			'password'              => bcrypt('password'),
			'email_verified_at'     => null,
		];

		User::factory()->create($data);

		$this->assertDatabaseHas('users', $data);
	}

	public function test_register_should_send_verification_link_to_the_provided_email_if_inputs_are_correct()
	{
		$username = 'johndoe';
		$email = 'johndoe@example.com';
		$password = 'password';

		$response = $this->post('/register', ['username'=>$username, 'email' => $email, 'password'=>$password, 'password_confirmation' => $password]);
		$response->assertSessionDoesntHaveErrors(['username', 'email', 'password', 'password_confirmation']);
		$response->assertRedirect('/email/verify');

		Event::fake([Registered::class]);
		Event::assertListening(
			Registered::class,
			SendEmailVerificationNotification::class,
		);
	}
}
