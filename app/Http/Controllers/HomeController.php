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
        $filter = ($request->filter) 
            ? $request->filter."%" 
            : "%";
        $expandPost = ($request->expandPost) 
            ? $request->expandPost 
            : false;
        $months = array_of_months(11);

        $posts = DB::table('users')
            ->leftjoin('posts', 'users.id', '=', 'posts.author')
            ->orderBy('posts.created_at', 'DESC')
            ->where('posts.created_at','LIKE',$filter)
            ->paginate(3);
        
        return view('home', compact('posts','months','filter','expandPost'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showArticle($id)
    {
        $author = DB::table('users')
            ->leftjoin('posts', 'users.id', '=', 'posts.author')
            ->where('posts.id', $id)->first();
        
        $author = $author->name;

        $post = Post::findOrFail($id);

        return view('article', compact('post','author'));
    }
}
