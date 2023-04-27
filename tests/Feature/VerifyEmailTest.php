<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class VerifyEmailTest extends TestCase
{
	use RefreshDatabase;

	public function test_user_is_being_verified_if_he_visits_verification_link()
	{
		Event::fake(Verified::class);

		$user = User::factory()->create([
			'email_verified_at' => null,
		]);
		$verificationUrl = URL::temporarySignedRoute(
			'verification.verify',
			Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
			[
				'id'   => $user->getKey(),
				'hash' => sha1($user->getEmailForVerification()),
			]
		);

		$response = $this->get($verificationUrl);
		Event::assertDispatched(Verified::class);

		$response->assertStatus(200);
		$response->assertViewIs('auth.success-email');
		$this->assertTrue($user->fresh()->hasVerifiedEmail());
	}
}
