<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Users;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = ($request->filter) ? $request->filter."%" : "%";

        $posts = Post::where('created_at','LIKE',$filter)->latest()->paginate(4);

        return view('home', compact('posts','filter'));
    }
}