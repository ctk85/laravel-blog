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
                <h1>Edit Post</h1>
                <div class="col-md-8">
                    <form method="post" action="{{ route('post.update', ['id' => $post->id]) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" id="id_title" name="title"
                                   aria-describedby="title" value="{{ $post->title }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="id_description" rows="8" name="description">{{ $post->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Post</button>
                        <a href="{{ URL::previous() }}">
                            <button type="button" class="btn btn-warning">Cancel</button>
                        </a>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection