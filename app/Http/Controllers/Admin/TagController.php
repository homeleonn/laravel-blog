<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
	public function index()
	{
		return view('admin.tags.index', ['tags' => Tag::get()]);
	}

	public function create()
	{
		return view('admin.tags.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'title' => 'required'
		]);

		Tag::create($request->all());
		
		return redirect()->route('tags.index');
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		return view('admin.tags.edit', ['tag' => Tag::findOrFail($id)]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'title' => 'required'
		]);

		Tag::findOrFail($id)
			->update($request->all());

		return redirect()->route('tags.index');
	}

	public function destroy($id)
	{
		Tag::destroy($id);
		
		return redirect()->route('tags.index');
	}
}
