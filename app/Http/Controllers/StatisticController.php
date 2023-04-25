<?php

namespace App\Http\Controllers;

use App\Models\Worldwide;

class StatisticController extends Controller
{
	protected $worldwideStats;

	public function __construct()
	{
		$this->worldwideStats = [
			'name'      => ['en' => 'Worldwide', 'ka' => 'მსოფლიო'],
			'confirmed' => Worldwide::all()->sum('confirmed'),
			'recovered' => Worldwide::all()->sum('recovered'),
			'deaths'    => Worldwide::all()->sum('deaths'),
		];
	}

	public function show()
	{
		return view('admin.dashboard', [
			'worldwideStats' => $this->worldwideStats,
		]);
	}

	public function index()
	{
		return view('admin.statistics', [
			'statistics'     => Worldwide::filter(request(['search', 'column', 'order']))->get(),
			'order'          => request('order'),
			'worldwideStats' => $this->worldwideStats,
		]);
	}
}
