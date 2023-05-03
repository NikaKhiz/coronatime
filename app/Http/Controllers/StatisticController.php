<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Services\StatisticService;
use Illuminate\View\View;

class StatisticController extends Controller
{
	public function show(): View
	{
		$worldwideStats = new StatisticService;
		return view('dashboard', [
			'worldwideStats' => $worldwideStats->getWorldwideStatistics(),
		]);
	}

	public function index(): View
	{
		$worldwideStats = new StatisticService;

		return view('statistics', [
			'statistics'     => Statistic::filter(request(['search', 'column', 'order']))->get(),
			'order'          => request('order'),
			'worldwideStats' => $worldwideStats->getWorldwideStatistics(),
		]);
	}
}
