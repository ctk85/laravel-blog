@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
        <div class="col-md-8">
            @if($categories->count() > 0)
            <div class="card">
                <div class="card-header">Categories</div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
    					<th>Name</th>
    					<th>Slug</th>
    					<th>Created</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ Carbon\Carbon::parse($category->created_at)->format('d-m-Y')  }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-1">{{ $categories->links() }}</div>
            @else
            <div class="jumbotron">
                <h4 class="text-center">No categories created!</h4>
            </div>
            @endif
        </div>
        <div class="col-md-4">
        	<div class="card">
        		<div class="card-header">New Category</div>
        		<div class="card-body">
	        		{!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
						<div class="form-group">
							{{ Form::label('name', 'Name') }}
							{{ Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
							<small id="nameHelp" class="form-text text-muted">Ex: 'PHP Tutorials'</small>
						</div>
						{{ Form::submit('Create New Category', ['class' => 'btn btn-outline-primary btn-block']) }}
	        		{!! Form::close() !!}
	        	</div>
        	</div>
        </div>
    </div>
</div>
@endsection