<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
	public function changeLanguage($locale): RedirectResponse
	{
		session()->put('locale', $locale);
		return redirect()->back();
	}
}
