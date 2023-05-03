<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
	public function changeLanguage($locale): RedirectResponse
	{
		session()->put('locale', $locale);
		return redirect()->back();
	}
}
