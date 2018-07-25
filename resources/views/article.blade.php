@extends('layouts.app')

@section('title')
    Article
@endsection

@section('content')
<div class="col-sm-12 blog-main">
	<div class="blog-post">
		<h2 class="blog-post-title">{{ $post->title }}</h2>
		<p class="blog-post-meta">
			<small><i>{{ Carbon\Carbon::parse($post->created_at)->format('l jS \of F Y') }} 
				by <a href="#">{{ $author }}</a></i></small></p>
		<p>{!! nl2br(e($post->description)) !!}</p>
	</div>
	<hr />

	<p class='lead'>Let us know what you think:</p>
	<div style="margin-bottom:50px;" v-if="user">
		<textarea class="form-control" rows="3" name="body" placeholder="Leave a comment" v-model="commentBox"></textarea>
		<button class="btn btn-success" style="margin-top:10px" @click.prevent="postComment">Save Comment</button>
	</div>
	<div v-else>
		<h4>You must be logged in to submit a comment!</h4> <a href="/login">Login Now &gt;&gt;</a>
	</div>
	
	<div class="media" style="margin-top:20px;" v-for="comment in comments">
	    <div class="media-left">
	        <a href="#">
	            <img class="media-object" src="http://placeimg.com/80/80" alt="...">
	        </a>
	    </div>
	    <div class="media-body">
	        <h4 class="media-heading">@{{comment.user.name}} said...</h4>
	        <p>
	          @{{comment.body}}
	        </p>
	        <span style="color: #aaa;">on @{{comment.created_at}}</span>
	    </div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	const app = new Vue({
		el: '#app',
		data: {
			comments: {},
			commentBox: '',
			post: {!! $post->toJson() !!},
			user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!}
		},
		mounted() {
			this.getComments();
			this.listen();
		},
		methods: {
			getComments() {
				axios.get('/api/article/'+this.post.id+'/comments')
				.then((response) => {
					this.comments = response.data
				})
				.catch(function (error) {
					console.log(error);
				});
			},
			postComment() {
				axios.post('/api/article/'+this.post.id+'/comment', {
					api_token: this.user.api_token,
					body: this.commentBox
				})
				.then((response) => {
					this.comments.unshift(response.data);
					this.commentBox = '';
				})
				.catch((error) => {
					console.log(error);
				})
			},
			listen() {
				Echo.channel('post.'+this.post.id)
				.listen('NewComment', (comment) => {
					this.comments.unshift(comment);
				})
			}
		}
	})
</script>
@endsection