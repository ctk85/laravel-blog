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
        $isLiked = (bool) LikePost::whereUserId(Auth::id())->wherePostId($post->id)->first();

    	return view('blog.article', compact('post','isLiked'));
    }

}
