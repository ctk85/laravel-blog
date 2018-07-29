<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SocialAccountService;
use Socialite;
use Auth;

class SocialAuthController extends Controller
{
    public function redirect()
    {
    	return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $service)
    {
    	try {
    		$user = $service->createOrGetUser(Socialite::driver('facebook')->user());
    		Auth::login($user, true);

    		toast('Logged in successfully!','success','top-right');
    		
    		return redirect()->to('/home');
    	
    	} catch(\Exception $e) {

    		return redirect('/redirect');
    	}
    }
}