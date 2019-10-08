<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController2 extends Controller
{
	public function register(Request $request)
	{
		$client = new \GuzzleHttp\Client();
		$response = $client->request('POST', 'http://telling_stories.test/api/user/register', [
			'headers' => [
				'Accept' => 'application/json',
			],
		]);
		dd($response);
	}
}
