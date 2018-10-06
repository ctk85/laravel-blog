<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Author</th>
				<th>Title</th>
				<th>Description</th>
				<th>Slug</th>
				<th>Created</th>
			</tr>
		</thead>
		<tbody>
			@foreach($posts as $post)
			<tr>
				<td>{{ $post->user->name }}</td>
				<td>{{ $post->title }}</td>
				<td>{{ $post->description }}</td>
				<td>{{ $post->slug }}</td>
				<td>{{ $post->created_at }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>