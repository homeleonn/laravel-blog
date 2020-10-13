<?php

namespace App\Models;

use App\Traits\TSluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, TSluggable;
    
    protected $fillable = ['title'];
    protected $sluggable = 'title';
	
	public function posts() {
		return $this->hasMany(Post::class);
    }
}
