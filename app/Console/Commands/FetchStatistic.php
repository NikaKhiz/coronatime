<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FetchStatistic extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'fetch:statistic';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'fetch country statistics';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$countryApi = 'https://devtest.ge/countries';
		$statisticsApi = 'https://devtest.ge/get-country-statistics';

		$countriesData = Http::get($countryApi)->object();
		foreach ($countriesData as $country) {
			DB::table('countries')
					->updateOrInsert(
						[
							'code'	=> $country->code,
						],
						[
							'code'	=> $country->code,
							'name'	=> json_encode($country->name),
						]
					);
		}

		$countries = Country::all();

		foreach ($countries as  $country) {
			$statistic = Http::post($statisticsApi, ['code' => $country->code])->object();
			DB::table('statistics')
					->updateOrInsert(
						[
							'country'       => $statistic->country,
						],
						[
							'country'       => $statistic->country,
							'code'          => $statistic->code,
							'confirmed'     => $statistic->confirmed,
							'recovered'     => $statistic->recovered,
							'critical'      => $statistic->critical,
							'deaths'        => $statistic->deaths,
							'country_id'    => $country->id,
						]
					);
		}

		$countriesStatistics = DB::table('countries')
							->join('statistics', 'countries.id', '=', 'country_id')
							->select('countries.name', 'statistics.confirmed', 'statistics.recovered', 'statistics.deaths')
							->get();

		foreach ($countriesStatistics as $statistic) {
			DB::table('worldwides')->updateOrInsert(
				[
					'name'      => $statistic->name,
				],
				[
					'name'      => $statistic->name,
					'confirmed' => $statistic->confirmed,
					'recovered' => $statistic->recovered,
					'deaths'    => $statistic->deaths,
				]
			);
		}
	}
}
