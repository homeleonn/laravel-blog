<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
		$this->validation();
		
		$post = Post::create($request->all());
		$this->setPost($request, $post);
		
		return redirect()->route('posts.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('admin.posts.edit', ['post' => Post::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
		$this->validation();
		
		$post = Post::findOrFail($id);
		$post->fill($request->all());
		$this->setPost($request, $post);
		
		return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        Post::findOrFail($id)->remove();
        
        return redirect()->route('posts.index');
    }
	
	public function setPost(Request $request, $post)
	{
		$post->setDate($request->get('date'));
		$post->setCategory($request->get('category_id'));
		$post->setTags($request->get('tags'));
		$post->uploadImage($request->get('image'));
	}
	
	
	public function validation()
	{
		if (request()->get('category_id') == 0) {
			request()->merge(['category_id' => null]);
		}
		
		request()->validate([
			'title' => 'required',
			'category_id' => 'nullable|integer|exists:categories,id',
			'tags.*' => 'integer',
			'tags' => 'nullable|array|exists:tags,id',
			'date' => 'nullable|date_format:m/d/Y',
			'image' => 'nullable|image',
		]);
	}
}
