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
        $months = array_of_months(11);

        $articles = Post::latest()->limit(6)->get();
        $articlesPop = Post::withCount('likes')->orderBy('likes_count', 'desc')->limit(6)->get();

        $posts = DB::table('users')
            ->leftjoin('posts', 'users.id', '=', 'posts.user_id')
            ->orderBy('posts.created_at', 'DESC')
            ->where('posts.created_at','LIKE',$filter)
            ->paginate(4);
        
        return view('home', compact('posts','months','filter','articles', 'articlesPop'));
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
            ->leftjoin('posts', 'users.id', '=', 'posts.user_id')
            ->where('posts.id', $id)->first();
        
        $author = $author->name;

        $post = Post::findOrFail($id);

        return view('article', compact('post','author'));
    }
}
