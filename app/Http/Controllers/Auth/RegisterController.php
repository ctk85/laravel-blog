<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Notification;
use Illuminate\Http\Request;
use App\Notifications\NewUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\NewUserRegisteredSuccessfully;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        $request->session()->invalidate();

        alert()->success('Success!','Your account has been created.')
            ->footer('Please check your eMail for the activation link.')
            ->showConfirmButton()
            ->showCloseButton();
       
        try { 
            $user->notify(new NewUserRegisteredSuccessfully($user));
            
            $admin = User::where('isAdmin', 1)->get();
            Notification::send($admin, new NewUser($user));
        } catch (\Exception $e) {} 
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /*
        try {
            // Notify admin(s)
            $admin = User::where('isAdmin', 1)->get();
            Notification::send($admin, new NewUser($data));

        } catch(\Exception $e){}
        */

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => str_random(60),
            'activation_code' => str_random(30).time()
        ]);
    }

    /**
     * Activate the user with given activation code.
     *
     * @param string $activationCode
     * @return string
     */
    public function activateUser(string $activationCode)
    {
        $user = User::whereActivationCode($activationCode)->first();
        if (!$user) {
            return redirect('/login')
                ->withErrors("The code does not exist for any user in our system.");
        }
        $user->status = 1;
        $user->activation_code = null;
        $user->save();
        auth()->login($user);
        
        alert()->success('Success!','Your account is now active!');
        return redirect('/');
    }
}