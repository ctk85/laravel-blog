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
                <h2>Create Post</h2>
                <div class="col-md-8">
                    <form method="POST" action="{{ route('post.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" id="id_title" name="title"
                                   aria-describedby="title" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="id_description" rows="6" name="description" placeholder="Description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Post</button>
                        <a href="{{ route('post.index') }}">
                            <button type="button" class="btn btn-warning">Cancel</button>
                        </a>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection