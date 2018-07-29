<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;

class PostController extends Controller
{
    /**
     * Auth required.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('users')
            ->leftjoin('posts', 'users.id', '=', 'posts.user_id')
            ->orderBy('posts.created_at', 'desc')
            ->where('users.id', Auth::user()->id)
            ->paginate(10);

        return view('post.index', compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $posts = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(10);
            
            return view('post.index-admin', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'description' => 'required'
        ]);

        $post = Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'user_id' => Auth::user()->id
        ]);

        alert()->success('Success!','Blog post has been successfully added!');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'description' => 'required'
        ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->slug = $request->slug;
        $post->save();

        alert()->success('Success!','Blog post, '.$post->title.', has been updated successfully!');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('post.index');
    }
}