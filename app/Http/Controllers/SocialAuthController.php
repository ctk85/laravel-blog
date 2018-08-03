<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SocialAccountService;
use Socialite;
use Auth;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        try {
           
           return Socialite::driver($provider)->redirect();
        
        } catch ( \InvalidArgumentException $e ) {

            return redirect('/login')->withErrors($e->getMessage());
        }
    }   

    public function callback(SocialAccountService $service, $provider)
    {
    	try {

    		$user = $service->createOrGetUser(Socialite::driver($provider)->user(), $provider);
    		Auth::login($user, true);

    		toast('Logged in successfully!','success','top-right');
    		
    		return redirect('/');

    	} catch(\Exception $e) {
            
    		return redirect('/login')->withErrors($e->getMessage());
    	}
    }
}