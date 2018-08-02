<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Category;

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
        $posts = Post::whereUserId(Auth::id())->with('user')->latest()->paginate(10);
        
        return view('post.index', compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $posts = Post::latest()->with('user')->paginate(10);
            
        return view('post.index-admin', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::pluck('name','id');

        return view('post.create', compact('categories'));
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
            'description' => 'required',
        ]);

        $post = Post::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category'),
            'user_id' => Auth::id()
        ]);

        alert()->success('Success!','Blog post, '.$request->input('title').', has been updated successfully!');
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
        $post = Post::findOrFail($id);
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
        $post = Post::findOrFail($id);
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
        //Validate
        $post = Post::findOrFail($id);
        if ($request->input('slug') == $post->slug) {
            $this->validate($request, [
                'title' => 'required|max:255',
                'description' => 'required'
            ]);
        } else {
            $this->validate($request, [
                'title' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'description' => 'required'
            ]);
        }

        //Save the data
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->slug = $request->input('slug');
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
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('post.index');
    }
}