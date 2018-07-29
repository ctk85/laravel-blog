<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Contracts\User as ProviderUser;
use Illuminate\Http\Request;
use App\SocialAccount;
use App\User;

class SocialAccountService extends Controller
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
    	$account = SocialAccount::whereProvider('facebook')
    		->whereProviderUserId($providerUser->getId())
    		->first();

    	if($account) {
    		return $account->user;
    	} else {

    		$account = new SocialAccount([
    			'provider_user_id' => $providerUser->getId(),
    			'provider' => 'facebook'
    		]);

    		$user = User::whereEmail($providerUser->getEmail())->first();

    		if(!$user) {

    			$user = User::create([
                    'name' => $providerUser->getName(),
    				'email' => $providerUser->getEmail(),
                    'password' => md5(rand(1,10000)),
                    'api_token' => str_random(60),
    			]);
    		}

    		$account->user()->associate($user);
    		$account->save();

    		return $user;
    	}
    }
}
