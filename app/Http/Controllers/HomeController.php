<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 0)
                    ->orderBy('id', 'DESC')
                    ->with('category', 'author')
                    ->paginate(2);
    	return view('pages.index', [
            'posts' => $posts,
            'title' => 'My Blog',
        ]);
    }

    public function show($slug)
    {
    	$post = Post::where('slug', $slug)->with([
            'category', 
            'tags', 
            'author', 
            'comments' => function($query){
                return $query->where('status', 1);
            }, 
            'comments.author'
        ])->firstOrFail();

    	return view('pages.post', ['post' => $post]);
    }

    public function category($slug)
    {
    	//DB::select('Select p.* from categories as c left join posts as p on c.id = p.category_id where c.slug = "***"');
    	$category 	= Category::whereSlug($slug)->firstOrFail();
    	$posts 		= $category->posts()->paginate(2);

    	$posts->map(function($post) use ($category){
    		$post->setRelation('category', $category);
    	});

    	return view('pages.list', ['term' => $category, 'posts' => $posts, 'type' => 'category']);
    }

    public function tag($slug)
    {
    	$tag = Tag::whereSlug($slug)->firstOrFail();
    	$posts = $tag->posts()->with('category')->paginate(2);
    	
    	return view('pages.list', ['term' => $tag, 'posts' => $posts, 'type' => 'tag']);
    }
}
