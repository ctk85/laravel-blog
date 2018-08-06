@extends('layouts.app')

@section('title')
	{{ $tag->name }} Tag
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>'{{ $tag->name }}' Tag <small class="text-muted">{{ $tag->posts()->count() }} Post(s) </small></h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('tag.edit', $tag->id) }}" class="btn btn-outline-primary float-right btn-block">Edit</a>
		</div>
		<div class="col-md-2">
			{!! Form::open(['route' => ['tag.destroy', 'id' => $tag->id], 'method' => 'POST' ]) !!}
				@method('DELETE')
				@csrf
				{{ Form::submit('Delete', ['class' => 'btn btn-outline-danger float-right btn-block']) }}
			{!! Form::close() !!}
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Tags</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($tag->posts as $post)
						<tr>
							<th>{{ $post->id }}</th>	
							<td>{{ $post->title }}</td>
							<td>
								@foreach($post->tags as $tag)
									<span class="badge badge-secondary">{{ $tag->name }}</span>
								@endforeach
							</td>
							<td><a href="{{ route('post.show', $post->id) }}" class="btn btn-outline-info btn-sm">View</a></td>
						</tr>
					@endforeach	
				</tbody>
			</table>
		</div>
	</div>
@endsection