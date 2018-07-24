@extends('layouts.app')

@section('title')
    Welcome to Chris' Blog!
@endsection

@section('content')
 
<div class="col-sm-8 blog-main">
  <div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta"><small><i>{{ Carbon\Carbon::parse($post->created_at)->format('l jS \of F Y') }} by <a href="#">{{ $post->name }}</a></i></small></p>
    <p>{{ $post->description }}</p>
  </div>
</div>
@endsection