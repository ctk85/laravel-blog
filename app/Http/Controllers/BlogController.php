<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function getArticle($slug) 
    {
    	$post = Post::whereSlug($slug)->first();
    	$articles = Post::latest()->limit(6)->get();
        $months = array_of_months(11);

    	return view('blog.article', compact('post','articles','months'));
    }

}
