@extends('layouts.app')

@section('title')
    Welcome to Chris' Blog!
@endsection

@section('content')
 
<div class="col-sm-8 blog-main">
@foreach($posts as $post)

    <div class="blog-post">
        <h2 class="blog-post-title">{{ $post->title }}</h2>
        <p class="blog-post-meta"><small><i>{{ Carbon\Carbon::parse($post->created_at)->format('l jS \of F Y') }} by <a href="#">{{ $post->name }}</a></i></small></p>
        <p>{{ str_limit($post->description, 400) }}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
          Learn More
        </button></p>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ $post->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {{ $post->description }}
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </div><!-- /.blog-post -->

@endforeach
<br>
<nav class="blog-pagination">
    {{ $posts->links() }}
</nav>

</div><!-- /.blog-main -->
@endsection