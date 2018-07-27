<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Comment;
use App\Events\NewComment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @param \App\Post  $post
     *
     */
    public function index(Post $post)
    {
        return response()->json($post->comments()
            ->with('user')->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|min:10',
        ]);

        $comment = $post->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id()
        ]);

        $comment = Comment::where('id', $comment->id)->with('user')->first();
        broadcast(new NewComment($comment))->toOthers();
        return $comment->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'body' => 'required|min:10',
        ]);

        $comment = Comment::find($request->comment_id);
        $comment->body = $request->body;
        $comment->save();

        $comment = Comment::where('id', $comment->id)->with('user')->first();
        broadcast(new NewComment($comment))->toOthers();
        return $comment->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
