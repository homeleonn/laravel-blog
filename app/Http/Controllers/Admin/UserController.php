<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', ['users' => User::get()]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validation();

        $user = User::add($request->all());
        $user->uploadImage($request->file('image'));
        
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('admin.users.edit', ['user' => User::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validation($user->id);

        $user->edit($request->all());
        $user->uploadImage($request->file('image'));
        
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->remove();
        
        return redirect()->route('users.index');
    }
	
	
	public function validation($id = null)
	{
		request()->validate([
            'name' => 'required',
            'email' => !$id ? 
				'required|email|unique:users' : 
				['required', 'email', Rule::unique('users')->ignore($id)],
            'image' => 'nullable|image',
        ]);
	}
}
