<?php

namespace App\Services;

use App\Models\Statistic;

class StatisticService
{
	public function getWorldwideStatistics()
	{
		return [
			'name'      => ['en' => 'Worldwide', 'ka' => 'მსოფლიო'],
			'confirmed' => Statistic::all()->sum('confirmed'),
			'recovered' => Statistic::all()->sum('recovered'),
			'deaths'    => Statistic::all()->sum('deaths'),
		];
	}
}
