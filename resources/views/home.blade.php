@extends('layouts.app')

@section('title')
    Welcome!
@endsection

@section('content')
 
<div class="col-sm-8 blog-main">
@if($posts->count() > 0)
  @foreach($posts as $post)
    <div class="blog-post">
        <h2 class="blog-post-title">{{ $post->title }}</h2>
        <p class="blog-post-meta"><small><i>{{ Carbon\Carbon::parse($post->created_at)->format('l jS \of F Y') }} by <a href="#">{{ $post->name }}</a></i></small></p>
        @if($expandPost && $expandPost == $post->id)
          <p>{!! nl2br(e($post->description)) !!}
          <a href="{{ route('home') }}">
            <button type="button" class="btn btn-warning btn-sm">Collapse</button>
          </a>
        @else
          <p>{{ str_limit($post->description, 400) }}
          <a href="{{ URL::to('?expandPost=' . $post->id) }}">
            <button type="button" class="btn btn-secondary btn-sm">Expand</button>
          </a>
        @endif
        <a href="{{ route('article', ['id' => $post->id]) }}">
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
@endsection