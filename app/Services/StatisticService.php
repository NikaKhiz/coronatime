<?php

namespace App\Services;

use App\Models\Statistic;

class StatisticService
{
	public static function getWorldwideStatistics(): array
	{
		return [
			'confirmed' => Statistic::all()->sum('confirmed'),
			'recovered' => Statistic::all()->sum('recovered'),
			'deaths'    => Statistic::all()->sum('deaths'),
		];
	}
}
