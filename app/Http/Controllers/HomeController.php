<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	return view('pages.index', ['posts' => Post::orderBy('id', 'DESC')->with('category')->paginate(2)]);
    }

    public function show($slug)
    {
    	$post = Post::where('slug', $slug)->with('category', 'tags')->firstOrFail();
    	return view('pages.post', ['post' => $post]);
    }
}
