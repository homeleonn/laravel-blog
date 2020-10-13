<?php

namespace App\Models;

use App\Traits\TSluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, TSluggable;
    
    protected $fillable = ['title'];
	
	public function posts() {
		return $this->belongsToMany(Post::class, 'post_tags', 'tag_id', 'post_id');
    }
}
