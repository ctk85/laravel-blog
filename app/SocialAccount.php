<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SocialAccount extends Model
{
	use LogsActivity;
	/**
     * LogActivity attributes.
     *
     * @var array
     */
	protected static $logAttributes = [
		'user_id', 'provider_user_id', 'provider'
	];

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'user_id', 'provider_user_id', 'provider'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
