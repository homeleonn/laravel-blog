<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Comment;
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

    public function update(Request $request)
    {
    	$user = Auth::user();

		$request->validate([
    		'name' => 'required',
    		'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
    		'image' => 'nullable|image',
    		'description' => 'nullable|max:1000',
    	]);

    	$user->edit($request->all());
    	$user->uploadImage($request->file('image'));

    	return redirect()->back()->with('status', 'Провиль успешно обновлен');
    }

    public function profile()
    {
    	return view('pages.profile', ['user' => Auth::user()]);
    }

    public function logout()
    {
    	Auth::logout();

    	return redirect('/');
    }

    public function sendComment(Request $request, $postId)
    {
    	$request->validate([
    		'text' => 'required|max:1000'
    	]);

    	Comment::create([
    		'text' => $request->get('text'),
    		'post_id' => $postId,
    		'user_id' => Auth::user()->id,
    	]);

    	return redirect()->back()->with('status', 'Комментарий успешно добавлен. Он будет отображаться после одобрения модератором.');
    }
}
