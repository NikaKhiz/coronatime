<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Services\StatisticService;
use Illuminate\View\View;

class StatisticController extends Controller
{
	public function show(): View
	{
		return view('dashboard', [
			'worldwideStats' => StatisticService::getWorldwideStatistics(),
		]);
	}

	public function index(): View
	{
		return view('statistics', [
			'statistics'     => Statistic::filter(request(['search', 'column', 'order']))->get(),
			'order'          => request('order'),
			'worldwideStats' => StatisticService::getWorldwideStatistics(),
		]);
	}
}
