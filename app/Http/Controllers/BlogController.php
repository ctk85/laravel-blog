<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LikePost;
use App\Post;
use Auth;

class BlogController extends Controller
{
    public function getArticle($slug) 
    {
    	$post = Post::whereSlug($slug)->first();
    	$articles = Post::latest()->limit(6)->get();
        $articlesPop = Post::withCount('likes')->orderBy('likes_count', 'desc')->limit(6)->get();
        $months = array_of_months(11);
        $isLiked = (bool) LikePost::whereUserId(Auth::id())->wherePostId($post->id)->first();

    	return view('blog.article', compact('post','articles','months','isLiked','articlesPop'));
    }

}
