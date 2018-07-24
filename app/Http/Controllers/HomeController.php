<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = ($request->filter) ? $request->filter."%" : "%"; 
        $months = array_of_months(11);

        $posts = DB::table('users')
            ->leftjoin('posts', 'users.id', '=', 'posts.author')
            ->orderBy('posts.created_at', 'DESC')
            ->where('posts.created_at','LIKE',$filter)
            ->paginate(3);
        
        return view('home', compact('posts','months','filter'));
    }

}
