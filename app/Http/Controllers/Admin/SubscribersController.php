<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscriber;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function index()
    {
        return view('admin.subscribers.index', ['subs' => Subscriber::all()]);
    }

    public function create()
    {
        return view('admin.subscribers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers'
        ]);
        
        Subscriber::add($request->all());
        return redirect()->route('subscribers.index');
    }

    public function destroy($id)
    {
        Subscriber::destroy($id);

        return redirect()->back();
    }
}
