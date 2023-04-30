<?php

namespace App\Http\Controllers\Statistic;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\View\View;

class StatisticController extends Controller
{
	protected $worldwideStats;

	public function __construct()
	{
		$this->worldwideStats = [
			'name'      => ['en' => 'Worldwide', 'ka' => 'მსოფლიო'],
			'confirmed' => Statistic::all()->sum('confirmed'),
			'recovered' => Statistic::all()->sum('recovered'),
			'deaths'    => Statistic::all()->sum('deaths'),
		];
	}

	public function show(): View
	{
		return view('dashboard', [
			'worldwideStats' => $this->worldwideStats,
		]);
	}

	public function index(): View
	{
		return view('statistics', [
			'statistics'     => Statistic::filter(request(['search', 'column', 'order']))->get(),
			'order'          => request('order'),
			'worldwideStats' => $this->worldwideStats,
		]);
	}
}