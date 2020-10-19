<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\Subscribe;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function add(Request $request)
    {
    	$request->validate([
    		'email' => 'required|email|unique:subscribers'
    	]);

    	$subscriber = Subscriber::add($request->all());
    	$subscriber->generateToken();

    	Mail::to($subscriber)->send(new Subscribe($subscriber));

    	return redirect()->back()->with('status', 'Подписка оформлена. На указанный почтовый адрес было отправлено письмо с подтверждением.');
    }

    public function verify(Request $request, $token)
    {
    	$sub = Subscriber::where('verify_token', $token)->firstOrFail();
    	$sub->verify_token = null;
    	$sub->save();

    	return redirect('/')->with('status', 'Подписка успешно подтверждена.');
    }
}
