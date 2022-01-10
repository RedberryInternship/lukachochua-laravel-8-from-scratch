<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use App\Services\Newsletter;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
	public function __invoke(Newsletter $newsletter, SessionRequest $request)
	{
		$request->validated();

		try
		{
			$newsletter->subscribe(request('email'));
		}
		catch (\Exception $e)
		{
			throw ValidationException::withMessages([
				'email' => 'This email could not be added to our newsletter list',
			]);
		}

		return redirect()->route('home')
			->with('success', 'You are now signed up for our newsletter!');
	}
}
