<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Notifications\NewUserRegisteredSuccessfully;
use App\Notifications\NewUser;
use Illuminate\Http\Request;
use App\SocialAccount;
use Notification;
use App\User;

class SocialAccountService extends Controller
{
    public function createOrGetUser(ProviderUser $providerUser, $provider)
    {
    	$account = SocialAccount::whereProvider($provider)
    		->whereProviderUserId($providerUser->getId())
    		->first();

    	if($account) {
    		return $account->user;
    	} else {

    		$account = new SocialAccount([
    			'provider_user_id' => $providerUser->getId(),
    			'provider' => $provider
    		]);

    		$user = User::whereEmail($providerUser->getEmail())->first();

    		if(!$user) {

                $name = ($providerUser->getName()) ?: $providerUser->getNickname();

    			$user = User::create([
                    'name' => $name,
    				'email' => $providerUser->getEmail(),
                    'password' => md5(rand(1,10000)),
                    'api_token' => str_random(60),
                    'status' => 1
    			]);

                try {
                    /** Notify Admin **/
                    $admin = User::where('isAdmin', 1)->get();
                    Notification::send($admin, new NewUser($user));

                    /** Notify New user **/
                    $user->notify(new NewUserRegisteredSuccessfully($user));

                } catch(\Exception $e){}
    		}

    		$account->user()->associate($user);
    		$account->save();

    		return $user;
    	}
    }
}
