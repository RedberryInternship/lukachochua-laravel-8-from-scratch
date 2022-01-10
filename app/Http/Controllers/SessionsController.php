<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
	public function create()
	{
		return view('sessions.create');
	}

	public function store(SessionRequest $request)
	{
		$attributes = $request->validated();

		if (Auth::attempt($attributes))
		{
			session()->regenerate();
			return redirect()->route('home')->with('success', 'Welcome Back!');
		}

		return back()
			->withInput()
			->withErrors(['email' => 'Your provided credentials could not be verified.']);
	}

	public function destroy()
	{
		Auth::logout();

		return redirect()->route('home')->with('success', 'Goodbye!');
	}
}
