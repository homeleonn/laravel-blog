<?php

namespace App\Models;

use App\Traits\TImagable;
use App\Traits\TSluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, TImagable, TSluggable;
    
    const IS_DRAFT = 0;
    const IS_PUBLIC = 1;
	const IS_FEATURED = 1;
	const IS_STANDARD = 0;
    
    private $terms;
    
    protected $fillable = ['title', 'content'];
    
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
//    public function getCategoryAttribute($value)
//    {
//        return $this->terms('category')->first();
//    }
//
////    public function getTagsAttribute($value)
////    {
////		return $this->terms('tag');
////    }
//
//    private function terms($type)
//    {
//        if (!$this->terms) {
//            $this->terms = $this->belongsToMany(Term::class, 'post_terms', 'post_id', 'term_id')->get()->groupBy('type');
//        }
//
//        return $this->terms[$type] ?? null;
//    }
//
//    public function tags()
//    {
//		return $this->belongsToMany(Term::class, 'post_terms', 'post_id', 'term_id')->where('type', 'tag');
//    }
//
//	public function sync($type, $ids) {
//		DB::table('post_terms')
//			->where('post_id', $this->id)
//			->whereIn(
//				'term_id',
//				DB::table('terms')
//					->where('type', $type)
//					->get('id')
//					->groupBy('id')
//					->keys()
//					->toArray())
//			->delete();
//
//		$this->tags()->attach($ids);
//	}
	
	public function category()
	{
		return $this->belongsTo(Category::class);
	}
	
	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
	}
	
    public static function add($fields)
    {
        $post = new static();
        $post->fill($fields);
        $post->save();
        
        return $post;
    }
    
    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
    
    public function remove()
    {
	    $this->removeImage();
		
        $this->delete();
    }
	
    public static function boot() {
        parent::boot();
		
        static::deleting(function($post) {
            \DB::table('post_tags')->where('post_id', $post->id)->delete();
        });
    }
	
	public function setDate($date)
	{
		$date = $date ? 
				\DateTime::createFromFormat('m/d/Y', $date)->format('Y-m-d'):
				date('Y-m-d', time());
		$this->created_at = $date;
		$this->updated_at = $date;
	}
	
	public function getDate()
	{
		return \DateTime::createFromFormat('Y-m-d', $this->created_at)->format('m/d/Y');
	}
    
	
	public function setCategory($id)
	{
		if ($id == null || $id < 1) {
			return;
		}
		
		$this->category_id = $id;
		$this->save();
    }
	
	public function setTags($ids)
	{
		if ($ids == null) {
			return;
		}
		
		$this->tags()->sync($ids);
	}
	
	public function setDraft()
	{
		$this->status = self::IS_DRAFT;
		$this->save();
	}
	
	public function setPublic()
	{
		$this->status = self::IS_PUBLIC;
		$this->save();
	}
	
	public function toggleStatus($value = null)
	{
		return $value ? $this->setDraft() : $this->setPublic();
	}
	
	public function setFeatured()
	{
		$this->status = self::IS_FEATURED;
		$this->save();
	}
	
	public function setStandard()
	{
		$this->status = self::IS_STANDARD;
		$this->save();
	}
	
	public function toggleFeatured($value = null)
	{
		return $value ? $this->setFeatured() : $this->setStandard();
	}
	
	public function getCategory()
	{
		return $this->category->title ?? 'Нет категории';
	}
	
	public function getTags()
	{
		return $this->tags->count() ? $this->tags->implode('title', ', ') : 'Нет тегов';
	}
}
