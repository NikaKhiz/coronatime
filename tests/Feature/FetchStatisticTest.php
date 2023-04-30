<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FetchStatisticTest extends TestCase
{
	use RefreshDatabase;

	use WithFaker;

	public function test_country_statistic_should_be_fetched_from_the_api()
	{
		$countryData = [
			'code' => 'AF',
			'name' => [
				'en' => 'Afghanistan',
				'ka' => 'ავღანეთი',
			],
		];
		
		Http::fake([
			'https://devtest.ge/countries' => Http::response([
				[
					'code' => 'AF',
					'name' => [
						'en' => 'Afghanistan',
						'ka' => 'ავღანეთი',
					],
				],
			], 200),
			'https://devtest.ge/get-country-statistics' => Http::response([
				'id'         => 1,
				'country'    => 'Afghanistan',
				'name'       => json_encode($countryData['name']),
				'confirmed'  => 5000,
				'recovered'  => 3000,
				'deaths'     => 1000,
			], 200),
		]);

		$this->artisan('fetch:statistic');
		$this->assertDatabaseHas('statistics', [
			'country'    => 'Afghanistan',
			'name'       => json_encode($countryData['name']),
			'confirmed'  => 5000,
			'recovered'  => 3000,
			'deaths'     => 1000,
		]);
		Http::assertSentCount(2);
	}
}
