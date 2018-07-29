@extends('layouts.app')

@section('content')
 <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-dark mb-3">
                <div class="card-header">
                    Edit Post
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['post.update', 'id' => $post->id], 'method' => 'POST']) !!}
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            {{ Form::label('title', 'Title:') }}
                            {{ Form::text('title', $post->title, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('slug', 'Slug:') }}
                            {{ Form::text('slug', $post->slug, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Description:') }}
                            {{ Form::textarea('description', $post->description, ['class' => 'form-control', 'rows' => '10']) }}
                        </div>
                            {{ Form::submit('Update Post', ['class' => 'btn btn-primary']) }}
                        {!! Html::linkRoute('post.show', 'Cancel', $post->id, ['class' => 'btn btn-warning']) !!}                
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection