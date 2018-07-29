@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12 ml-sm-auto pt-3">
        <div class="card border-dark mb-3">
            <div class="card-header">
                Create Post
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'post.store', 'method' => 'POST']) !!}
                    @csrf
                    <div class="form-group">
                        {{ Form::label('title', 'Title') }}
                        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter title']) }}
                    </div>
                     <div class="form-group">
                        {{ Form::label('slug', 'Slug') }}
                        {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Enter slug']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', 'Description') }}
                        {{ Form::textarea('description', null, ['rows' => '6', 'class' => 'form-control', 'placeholder' => 'Description']) }}
                    </div>
                    {{ Form::submit('Create Post', ['class' => 'btn btn-primary']) }}
                    {!! Html::linkRoute('post.index', 'Cancel', null, ['class' => 'btn btn-warning']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection