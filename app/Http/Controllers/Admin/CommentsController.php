<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function index()
    {
    	return view('admin.comments.index', ['comments' => Comment::all()]);
    }

    public function toggleStatus($commentId)
    {
    	Comment::findOrFail($commentId)->toggleStatus();

    	return redirect()->back();
    }

    public function destroy($commentId)
    {
    	Comment::destroy($commentId);

    	return redirect()->back();
    }
}
