<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function index()
	{
		return view('admin.categories.index', ['categories' => Category::get()]);
	}

	public function create()
	{
		return view('admin.categories.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'title' => 'required'
		]);

		Category::create($request->all());
		
		return redirect()->route('categories.index');
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		return view('admin.categories.edit', ['category' => Category::findOrFail($id)]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'title' => 'required'
		]);

		Category::findOrFail($id)
			->update($request->all());

		return redirect()->route('categories.index');
	}

	public function destroy($id)
	{
		Category::destroy($id);
		
		return redirect()->route('categories.index');
	}
}
