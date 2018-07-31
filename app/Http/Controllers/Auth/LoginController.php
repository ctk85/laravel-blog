<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = '/';


    protected function authenticated(Request $request, $user)
    {
        if ($user->status === 1) {
            toast('Logged in successfully!','success','top-right');
            return redirect('/');
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        alert()->warning('Warning','Your account is not active')
            ->footer('<a href="#">Click here to re-send your activation link.</a>')
            ->showConfirmButton()
            ->showCloseButton();

        return redirect('/');
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
}
