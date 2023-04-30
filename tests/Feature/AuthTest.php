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
		$response = $this->get(route('view.login'));
		$response->assertSuccessful();
		$response->assertViewIs('auth.login');
	}

	public function test_auth_should_give_us_an_errors_if_no_inputs_provided()
	{
		$response = $this->post(route('login_user'));
		$response->assertSessionHasErrors([
			'username',
			'password',
		]);
	}

	public function test_auth_should_give_us_an_error_if_user_doesnt_provide_email_or_username()
	{
		$response = $this->post(route('login_user'), ['password'=>'password']);
		$response->assertSessionHasErrors([
			'username',
		]);
		$response->assertSessionDoesntHaveErrors(['password']);
	}

	public function test_auth_should_give_us_an_error_if_provided_email_or_username_is_less_then_three_charecters()
	{
		$response = $this->post(route('login_user'), ['username'=>'un', 'password'=>'password']);
		$response->assertSessionHasErrors(['username']);
	}

	public function test_auth_should_give_us_an_error_if_user_doesnt_provide_password()
	{
		$response = $this->post(route('login_user'), ['username'=>'username']);
		$response->assertSessionHasErrors([
			'password',
		]);
		$response->assertSessionDoesntHaveErrors(['username']);
	}

	public function test_auth_should_give_us_an_error_if_there_is_no_user_record_with_provided_credentials()
	{
		$response = $this->post(route('login_user'), [
			'username' => 'gela',
			'password' => 'password',
		]);
		$response->assertSessionHasErrors(['username']);
	}

	public function test_auth_should_redirect_to_email_verification_if_user_with_provided_credentials_is_not_verified()
	{
		$username = 'testusername';
		$password = 'password';
		$verified = null;
		$user = User::factory()->create(['username'=>$username, 'password' => bcrypt($password), 'email_verified_at' => $verified]);
		$response = $this->post(route('login_user'), [
			'username'          => $user->username,
			'password'          => $user->password,
			'email_verified_at' => $user->email_verified_at,
		]);
		$response->assertRedirect(route('verification.notice'));
	}

	public function test_auth_should_give_us_an_error_if_registered_user_provides_incorrect_password()
	{
		$user = User::factory()->create([
			'username' => 'gela',
			'email'    => 'gela@example.com',
			'password' => 'password',
		]);

		$response = $this->post(route('login_user'), [
			'username' => $user->username,
			'password' => 'incorrectpassword',
		]);
		$response->assertSessionHasErrors(['username']);
	}

	public function test_auth_should_redirect_to_dashboard_after_succesfull_login()
	{
		$username = 'testusername';
		$password = 'password';
		$user = User::factory()->create(['username'=>$username, 'password' => bcrypt($password)]);
		$response = $this->post(route('login_user'), [
			'username' => $username,
			'password' => $password,
		]);
		$response->assertRedirect(route('dashboard'));
	}

public function test_logout_page_is_not_accessible_for_not_authenticated_users()
{
	$response = $this->get(route('logout_user'));
	$response->assertRedirect(route('login_user'));
}

	public function test_logout_should_log_out_authenticated_user()
	{
		$user = User::factory()->create();

		$response = $this->actingAs($user)->get(route('logout_user'));
		$response->assertRedirect(route('login_user'));

		$this->assertGuest();
	}
}
