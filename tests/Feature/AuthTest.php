<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
	use RefreshDatabase;

	public function test_login_page_is_accessible()
	{
		$response = $this->get('/login');
		$response->assertSuccessful();
		$response->assertViewIs('auth.login');
	}

	public function test_auth_should_give_us_an_errors_if_no_inputs_provided()
	{
		$response = $this->post('/login');
		$response->assertSessionHasErrors([
			'username',
			'password',
		]);
	}

	public function test_auth_should_give_us_an_error_if_user_doesnt_provide_email_or_username()
	{
		$response = $this->post('/login', ['password'=>'password']);
		$response->assertSessionHasErrors([
			'username',
		]);
		$response->assertSessionDoesntHaveErrors(['password']);
	}

	public function test_auth_should_give_us_an_error_if_provided_email_or_username_is_less_then_three_charecters()
	{
		$response = $this->post('/login', ['username'=>'un', 'password'=>'password']);
		$response->assertSessionHasErrors(['username']);
	}

	public function test_auth_should_give_us_an_error_if_user_doesnt_provide_password()
	{
		$response = $this->post('/login', ['username'=>'username']);
		$response->assertSessionHasErrors([
			'password',
		]);
		$response->assertSessionDoesntHaveErrors(['username']);
	}

	public function test_auth_should_give_us_an_error_if_there_is_no_user_record_with_provided_credentials()
	{
		$response = $this->post('/login', [
			'username' => 'gela',
			'password' => 'password',
		]);
		$response->assertSessionHasErrors(['username'=> 'There is no user record with provided username or email.']);
	}

	public function test_auth_should_redirect_to_email_verification_if_user_with_provided_credentials_is_not_verified()
	{
		$username = 'testusername';
		$password = 'password';
		$verified = null;
		$user = User::factory()->create(['username'=>$username, 'password' => bcrypt($password), 'email_verified_at' => $verified]);
		$response = $this->post('/login', [
			'username' => $username,
			'password' => $password,
		]);
		$response->assertRedirect('/email/verify');
	}

	public function test_auth_should_redirect_to_dashboard_after_succesfull_login()
	{
		$username = 'testusername';
		$password = 'password';
		$user = User::factory()->create(['username'=>$username, 'password' => bcrypt($password)]);
		$response = $this->post('/login', [
			'username' => $username,
			'password' => $password,
		]);
		$response->assertRedirect('/dashboard');
	}
}
