<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
		return view('admin.posts.index', ['posts' => Post::with('category', 'tags')->get()]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
		$this->setPostData($request, new Post)->save();
		
		return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        return view('admin.posts.edit', ['post' => Post::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
		$this->setPostData($request, Post::findOrFail($id))->save();
		
		return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        Post::findOrFail($id)->remove();
        
        return redirect()->route('posts.index');
    }
	
	public function setPostData(Request $request, $post, $validation = true)
	{
		if ($validation) $this->validation($request);
		$post->fill($request->all());
		$post->setDate($request->get('date'));
		$post->setCategory($request->get('category_id'));
		$post->save();
		$post->setTags($request->get('tags'));
		$post->uploadImage($request->file('image'));
		$post->toggleFeatured($request->get('is_featured'));
		$post->toggleStatus($request->get('status'));
		// dd($request->get('is_featured'), $request->get('status'), $post);
		return $post;
	}
	
	
	public function validation(Request $request)
	{
		if ($request->get('category_id') == 0) {
			$request->merge(['category_id' => null]);
		}
		
		$request->validate([
			'title' => 'required',
			'content' => 'required',
			'category_id' => 'nullable|integer|exists:categories,id',
			'tags.*' => 'integer',
			'tags' => 'nullable|array|exists:tags,id',
			'date' => 'required|date_format:d/m/y',
			'image' => 'nullable|image',
		]);
	}
}
