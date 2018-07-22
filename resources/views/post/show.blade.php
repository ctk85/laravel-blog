@extends('layouts.app')
 
@section('content')
    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Post <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nav item again</a>
                    </li>
                </ul>
            </nav>
 
            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                <h1>{{ $post->title }}</h1>
                <div class="col-sm-8 blog-main">
                    <p>{{ $post->description }}</p>
                    
                    <div class="row">
                        <a href="{{ route('post.edit', ['id' => $post->id]) }}">
                            <button type="button" class="btn btn-primary btn-sm">Edit Post</button>
                        </a>
                        &nbsp;
                        <form method="POST" action="{{ route('post.destroy', ['id' => $post->id]) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete Post</button>
                        </form>
                        &nbsp;
                        <a href="{{ route('post.index') }}">
                            <button type="button" class="btn btn-warning btn-sm">Cancel</button>
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection