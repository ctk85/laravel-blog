<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class LikePostController extends Controller
{

    public function likePost(Post $post)
    {
        Auth::user()->likes()->attach($post->id);

        return back();
    }

    public function unLikePost(Post $post)
    {
        Auth::user()->likes()->detach($post->id);

        return back();
    }

    public function getLikes(Post $post)
    {
        return response()->json($post->likes()->latest()->get());
    }
}
