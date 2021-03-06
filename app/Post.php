<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\LikePost;
use Auth;

class Post extends Model
{
    use LogsActivity;
    
    /**
     * LogActivity attributes.
     *
     * @var array $logAttributes
     */
    protected static $logAttributes = [
        'title', 'slug', 'user_id',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'title', 'description', 'user_id', 'slug', 'category_id',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function comments()
    {
    	return $this->hasMany('App\Comment');
    }

    public function category()
    {
        return $this->belongsTo('App\Category')->withDefault(function ($category) {
            $category->name = 'General';
        });
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function likes()
    {
        return $this->belongsToMany('App\User', 'like_posts', 'post_id', 'user_id')->withTimeStamps();
    }

    public function liked()
    {
        return (bool) LikePost::whereUserId(Auth::id())->wherePostId($this->id)->first();
    }
    
}
