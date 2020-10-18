<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function registerForm()
    {
    	return view('pages.register');
    }

    public function register(Request $request)
    {
		$request->validate([
    		'name' => 'required',
    		'email' => 'required|email|unique:users',
    		'password' => 'required|min:5',
    	]);

        $user = User::add($request->all());
        
        return redirect()->route('login.form')->with('status', 'Регистрация прошла успешно');
    }

    public function loginForm()
    {
    	return view('pages.login');
    }

    public function login(Request $request)
    {
    	$request->validate([
    		'email' => 'required|email',
    		'password' => 'required',
    	]);

    	if ( Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')]) ) {
    		return redirect()->route('home');
    	}

    	return redirect()->back()->with('status', 'Неправильной логин или пароль');
    }

    public function edit(Request $request)
    {
		$request->validate([
    		'name' => 'required',
    		'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
    		'password' => 'required|min:5',
    	]);
    }

    public function profile()
    {
    	if (Auth::check()) {
    		return view('pages.profile', ['user' => Auth::user()]);
    	}

    	return abort(404);
    }
}
