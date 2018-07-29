<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function getArticle($slug) 
    {
    	$post = Post::where('slug', $slug)->first();
    	$articles = Post::orderBy('created_at', 'desc')->limit(6)->get();
        $months = array_of_months(11);

    	$author = DB::table('users')
            ->leftjoin('posts', 'users.id', '=', 'posts.user_id')
            ->where('posts.slug', $slug)->first();
        $author = $author->name;

    	return view('blog.article', compact('post','author','articles','months'));
    }
}
