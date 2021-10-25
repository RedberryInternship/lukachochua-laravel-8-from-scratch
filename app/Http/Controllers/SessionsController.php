<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)) {
            session()->regenerate();
            return redirect('/')->with('success', 'Welcome Back!');
        }

        return back()
            ->withInput()
            ->withErrors(['email' => 'Your provided credentials could not be verified.']);
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
