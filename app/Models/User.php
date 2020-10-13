<?php

namespace App\Models;

use App\Traits\TImagable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TImagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    const IS_ACCESSLEVEL_ADMIN = 1;
    const IS_ACCESSLEVEL_NORMAL = 0;
	const IS_STATUS_BAN = 1;
	const IS_STATUS_UNBAN = 0;
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public static function add($fields)
    {
    	$user = new static();
    	$user->fill($fields);
    	$user->hashPassword($fields['password']);
    	$user->save();
    	
    	return $user;
    }
    
    public function edit($fields)
    {
    	$this->fill($fields);
	    $this->hashPassword($fields['password'] ?? null);
    	$this->save();
    }
	
	public function remove()
	{
		$this->removeImage();
		$this->delete();
	}
    
    private function hashPassword($passwordString)
    {
        if (!$passwordString) {
            unset($this->password);
            return;
        }
        
    	$this->password = bcrypt($passwordString);
    }
    
    public function makeAdmin()
    {
    	$this->accesslevel = self::IS_ACCESSLEVEL_ADMIN;
    	$this->save();
    }
	
	public function makeNormal()
	{
		$this->accesslevel = self::IS_ACCESSLEVEL_NORMAL;
		$this->save();
	}
	
	public function toggleAdmin($value = null)
	{
		$this->accesslevel = $value ? $this->makeAdmin() : $this->makeNormal();
	}
	
	public function ban()
	{
		$this->status = self::IS_STATUS_BAN;
		$this->save();
	}
	
	public function unban()
	{
		$this->status = self::IS_STATUS_UNBAN;
		$this->save();
	}
	
	public function toggleStatus($value = null)
	{
		$this->status = $value ? $this->ban() : $this->unban();
	}
}
