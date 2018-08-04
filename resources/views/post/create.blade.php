@extends('layouts.app')

@section('title')
    Create Post
@endsection

@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')
<div class="container-fluid">
    <div class="col-sm-8 offset-md-2">
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
                        {{ Form::label('category', 'Category') }}
                        {{ Form::select('category', $categories, null, ['class' => 'form-control']) }}
                        <small id="nameHelp" class="form-text text-muted">To add a new category, click <a href="/category">here</a></small>
                    </div>
                    
                    <div class="form-group">
                        {{ Form::label('tags', 'Tags') }}
                        {{ Form::select('tags[]', $tags, null, ['class' => 'form-control js-example-basic-multiple', 'multiple' => 'multiple']) }}
                        <small id="nameHelp" class="form-text text-muted">To add a new tag, click <a href="/tag">here</a></small>
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

@section('scripts')
    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection