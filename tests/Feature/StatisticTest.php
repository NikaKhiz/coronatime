<?php

namespace Tests\Feature;

use App\Models\Statistic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class StatisticTest extends TestCase
{
	use RefreshDatabase;

	use WithFaker;

	protected $user;

	protected function setUp(): void
	{
		parent::setUp();
		$this->user = User::factory()->create([
			'username' => 'johndoe',
			'email'    => 'johndoe@example.com',
			'password' => bcrypt('password'),
		]);
	}

		public function test_dashboard_page_is_not_accessible_for_not_authenticated_users()
		{
			$response = $this->get(route('dashboard'));
			$response->assertStatus(302);
			$response->assertRedirect(route('view.login'));
		}

		public function test_statistics_page_is_not_accessible_for_not_authenticated_users()
		{
			$response = $this->get(route('statistics'));
			$response->assertStatus(302);
			$response->assertRedirect(route('view.login'));
		}

		public function test_dashboard_page_is_accessible()
		{
			$response = $this->actingAs($this->user)->get(route('dashboard'));
			$response->assertSuccessful();
			$response->assertViewIs('dashboard');
		}

		public function test_statistics_page_is_accessible()
		{
			$response = $this->actingAs($this->user)->get(route('statistics'));
			$response->assertSuccessful();
			$response->assertViewIs('statistics');
		}

		public function test_filter_search_country_by_its_name()
		{
			$countryData = [
				'code' => 'AF',
				'name' => [
					'en' => 'Afghanistan',
					'ka' => 'ავღანეთი',
				],
			];
			$model1 = Statistic::create([
				'country'    => 'Afghanistan',
				'name'       => json_encode($countryData['name']),
				'confirmed'  => 5000,
				'recovered'  => 3000,
				'deaths'     => 1000,
			]);
			App::setLocale('en');
			$results = Statistic::filter(['search' => 'Afghanistan'])->get();
			$this->assertCount(1, $results);
			$this->assertTrue($results->contains($model1));
		}

		public function test_filter_by_column_and_order()
		{
			$countryData = [
				'code' => 'AF',
				'name' => [
					'en' => 'Afghanistan',
					'ka' => 'ავღანეთი',
				],
			];

			$model1 = Statistic::create([
				'country'    => 'Afghanistan',
				'name'       => json_encode($countryData['name']),
				'confirmed'  => 5000,
				'recovered'  => 3000,
				'deaths'     => 1000,
			]);

			$results = Statistic::filter(['column' => 'country', 'order' => 'desc'])->get();
			$this->assertCount(1, $results);
			$this->assertEquals($model1->id, $results[0]->id);
		}
}
