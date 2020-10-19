<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    const IS_ALLOW 		= 1;
    const IS_DISALLOW 	= 0;

    protected $fillable = ['text', 'post_id', 'user_id'];
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDate()
    {
    	return $this->created_at->diffForHumans();
    }

    public function toggleStatus()
    {
    	$this->status = $this->status == self::IS_ALLOW ? self::IS_DISALLOW : self::IS_ALLOW;
    	$this->save();
    }
}
