@extends('layouts.app')

@section('title')
  Edit Tag
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
                    {!! Form::model($tag, ['route' => ['tag.update', 'id' => $tag->id], 'method' => 'POST']) !!}
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            {{ Form::label('name', 'Name:') }}
                            {{ Form::text('name', $tag->name, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                        </div> 
                        {{ Form::submit('Update Tag', ['class' => 'btn btn-success']) }}
                        {!! Html::linkRoute('tag.show', 'Cancel', $tag->id, ['class' => 'btn btn-warning']) !!}  
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection