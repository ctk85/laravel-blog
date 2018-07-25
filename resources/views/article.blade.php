@extends('layouts.app')

@section('title')
    Article
@endsection

@section('content')
<div class="col-sm-12 blog-main">
	<div class="blog-post">
		<div class="blog-text-border">
			<h2 class="blog-post-title">{{ $post->title }}</h2>
			<p class="blog-post-meta">
				<small><i>{{ Carbon\Carbon::parse($post->created_at)->format('l jS \of F Y') }} 
					by <a href="#">{{ $author }}</a></i></small></p>
			<hr />
			{!! nl2br(e($post->description)) !!}
		</div>
	</div>
	<div style="margin-bottom:20px;" v-if="user">
		<div class="blog-text-border">
			<textarea class="form-control" rows="3" name="body" placeholder="Leave a comment" v-model="commentBox"></textarea>
			<button class="btn btn-success" style="margin-top:10px" @click.prevent="postComment">Save Comment</button>
		</div>
	</div>
	<div class="blog-text-border" v-else>
		<p class="lead text-center">You must be logged in to submit a comment.&nbsp;<a href="/login">Login Now &gt;&gt;</a></p>
	</div>

	<div v-if="comments[0]">
		<div class="blog-text-border">
			<div class="media" style="margin-top:20px;" v-for="comment in comments">
			    <div class="media-left" style="padding-right: 20px;">
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
	</div>
	<div class="blog-text-border" v-else>
		<p class="lead text-center">Be the first to leave a comment!</p>
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