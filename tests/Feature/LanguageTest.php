<?php

namespace Tests\Feature;

use App\Http\Middleware\ChangeLocale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Mockery;
use Tests\TestCase;

class LanguageTest extends TestCase
{
	use RefreshDatabase;

	public function test_handle_sets_locale_from_session()
	{
		$this->assertEquals('en', app()->getLocale());
		$this->get(route('change_language', ['locale' => 'ka']));
		$this->assertEquals('ka', session('locale'));

		$request = new Request();
		$response = new Response();

		$session = Mockery::mock('Illuminate\Session\Store');
		$session->shouldReceive('has')->with('locale')->andReturn(true);
		$session->shouldReceive('get')->with('locale')->andReturn(session('locale'));

		$middleware = new ChangeLocale($session);
		$middlewareResponse = $middleware->handle($request, function() use($response){
			return $response;
		});
		
		App::shouldReceive('getLocale')
			->once()
			->andReturn('ka');
		$this->assertEquals(session('locale'), App::getLocale());
		$this->assertSame($response, $middlewareResponse);
	}
}
