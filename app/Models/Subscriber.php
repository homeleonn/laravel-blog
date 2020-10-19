<?php

namespace App\Models;

use Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['email'];

    public static function add($fields)
    {
    	$subscriber = new static($fields);
    	$subscriber->created_at = date('Y-m-d H:i:s', time());
    	$subscriber->save();

    	return $subscriber;
    }

    public function generateToken()
    {
    	$this->verify_token = Str::random(100);
    	$this->save();
    }

    public function verify($token)
    {
    	$subscriber = self::where('verify_token', $token)->firstOrFail();
    	$subscriber->verify_token = null;
    	$subscriber->save();
    }
}
