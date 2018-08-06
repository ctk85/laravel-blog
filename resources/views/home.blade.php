@extends('layouts.app')

@section('title')
    Welcome!
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 blog-main">
      <div class="jumbotron">
          <h1 class="display-4">Hello, welcome to {{ env('APP_NAME') }}!</h1>
          <p class="lead">Thank you so much for visiting. This is a test blog site built with Laravel. Please read my popular blog!</p>
          <hr class="my-4">
          <a class="btn btn-primary btn-lg" href="#" role="button">Popular Blog</a>
      </div>
    </div>

    <div class="col-sm-8 blog-main">
        @if($posts->count() > 0)
        @foreach($posts as $post)
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $post->title }}</h2>
            <p class="blog-post-meta"><small><i>{{ Carbon\Carbon::parse($post->created_at)->format('l jS \of F Y') }} by <a href="#">{{ $post->name }}</a></i></small></p>
            <p>{{ str_limit($post->description, 400) }}
                <a href="{{ route('blog.article', ['id' => $post->slug]) }}">
                    <button type="button" class="btn btn-primary btn-sm">Learn More</button>
                </a>
            </p>
        </div>
        @endforeach
        @else
        <div class="flex-center position-ref">
            <div class="content">
                <p class="lead" align="center">No blog posts for {{ Carbon\Carbon::parse(str_replace('%','',$filter))->format('F Y') }}</p>
            </div>
        </div>
        @endif
        <br>
        <nav class="blog-pagination">
            {{ $posts->links() }}
        </nav>

    </div><!-- /.blog-main -->
    @include('partials._sidebar')
</div><!-- row -->
@endsection