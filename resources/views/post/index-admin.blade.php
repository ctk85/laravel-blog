@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-sm-12 ml-sm-auto pt-3">
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