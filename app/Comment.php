<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Comment extends Model
{
    use LogsActivity;
    /**
     * LogActivity attributes.
     *
     * @var array
     */
    protected static $logAttributes = [
        'user_id', 'post_id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 'user_id', 'post_id'
    ];

    public function post()
    {
    	return $this->belongsTo('App\Post');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
