@extends('layouts.app')

@section('title')
  Edit Post
@endsection

@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')
 <div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
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
                            {{ Form::label('category', 'Category') }}
                            {{ Form::select('category', $categories, null, ['class' => 'form-control']) }}
                            <small id="nameHelp" class="form-text text-muted">To add a new category, click <a href="/category">here</a></small>
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label('tags', 'Tags') }}
                            {{ Form::select('tags[]', $tags, $post->tags, ['class' => 'form-control js-example-basic-multiple', 'multiple' => 'multiple']) }}
                            <small id="nameHelp" class="form-text text-muted">To add a new tag, click <a href="/tag">here</a></small>
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

@section('scripts')
    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection