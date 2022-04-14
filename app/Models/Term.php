<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->hasMany(Post::class, 'post_terms', 'term_id');
    }
}
