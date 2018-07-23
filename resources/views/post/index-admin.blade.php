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
                <h1>All&nbsp;Posts
                    <a href="{{ route('post.create') }}">
                        <button type="button" class="btn btn-primary btn-sm">Create Post</button>
                    </a>
                </h1>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Learn more</th>
                        <th>Created on</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($posts)
                        @foreach($posts as $post)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->name }}</td>
                                <td>
                                    <a href="{{ route('post.show', ['id' => $post->id]) }}">view more</a>
                                </td>
                                <td>{{ Carbon\Carbon::parse($post->created_at)->format('d-m-Y')  }}</td>
                            </tr>
                        @endforeach
                    @else
                        <p class="text-center text-primary">No Posts created Yet!</p>
                    @endif
                </table><Br>
                {{ $posts->links() }}
            </main>
        </div>
    </div>
@endsection