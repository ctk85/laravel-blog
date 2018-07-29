@extends('layouts.app')

@section('title')
    My Posts
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-12">
                <h1>My&nbsp;Posts
                    {!! Html::linkRoute('post.create', 'Create Post', null, ['class' => 'btn btn-primary btn-sm']) !!}
                    {!! Html::linkRoute('home', 'Go Home', null, ['class' => 'btn btn-warning btn-sm']) !!}
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
                                <td>{{ $post->user->name }}</td>
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