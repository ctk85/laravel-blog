<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected function authenticated(Request $request, $user)
    {
        $getJoke = $this->dadJoke();
        $joke = " ... ".$getJoke['joke'];
        $userParts = explode(' ',$user->name);
        $firstName = $userParts[0];
        $msg = "Welcome, ".$firstName."!".$joke;

        $request->session()->flash('info', $msg);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function dadJoke()
    {
        $client = new Client();
        try {
            $res = $client->request('GET', 'https://icanhazdadjoke.com', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json'
            ]]);
            $joke = json_decode($res->getBody(), true);
            
            return $joke;
        
        } catch(\Exception $e) {}
    }
}
