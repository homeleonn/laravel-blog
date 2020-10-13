<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class TestController extends Controller
{
	public function hello(Request $request)
	{
	    $post = Post::whereId(1)->count();
	    dump($post);
	}
}
