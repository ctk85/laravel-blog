@extends('layouts.app')

@section('title')
    Tags
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
        <div class="col-md-8">
            @if($tags->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
    					<th>Name</th>
    					<th>Created</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td><a href="{{ route('tag.show', $tag->id) }}">{{ $tag->name }}</a></td>
                                <td>{{ Carbon\Carbon::parse($tag->created_at)->format('d-m-Y')  }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <div class="mt-1">{{ $tags->links() }}</div>
            @else
            <div class="jumbotron">
                <h4 class="text-center">No tags created!</h4>
            </div>
            @endif
        </div>
        <div class="col-md-4">
        	<div class="card">
        		<div class="card-header">New Tag</div>
        		<div class="card-body">
	        		{!! Form::open(['route' => 'tag.store', 'method' => 'POST']) !!}
						<div class="form-group">
							{{ Form::label('name', 'Name') }}
							{{ Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
							<small id="nameHelp" class="form-text text-muted">Ex: 'Marketing'</small>
						</div>
						{{ Form::submit('Create New Tag', ['class' => 'btn btn-outline-primary btn-block']) }}
	        		{!! Form::close() !!}
	        	</div>
        	</div>
        </div>
    </div>
</div>
@endsection