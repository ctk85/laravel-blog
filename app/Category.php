<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
	use LogsActivity;

	/**
     * LogActivity attributes.
     *
     * @var array $logAttributes
     */
    protected static $logAttributes = [
    	'name', 'id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
	protected $fillable = [
		'name'
	];

    public function posts()
    {
    	return $this->hasMany('App\Post');
    }
}
