<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable;
    use LogsActivity;

    /**
     * LogActivity attributes.
     *
     * @var array $logAttributes
     */
    protected static $logAttributes = [
        'name', 'email', 'id', 'status'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'api_token', 
        'status', 
        'activation_code', 
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array $hidden
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function accounts()
    {
        return $this->hasMany('App\SocialAccount');
    }
}
