<?php

namespace App\Console\Commands;

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
			$statistic = Http::post($statisticsApi, ['code' => $country->code])->object();
			DB::table('statistics')
				->updateOrInsert(
					[
						'country'       => $statistic->country,
					],
					[
						'country'       => $statistic->country,
						'name'          => json_encode($country->name),
						'confirmed'     => $statistic->confirmed,
						'recovered'     => $statistic->recovered,
						'deaths'        => $statistic->deaths,
					]
				);
		}
	}
}
