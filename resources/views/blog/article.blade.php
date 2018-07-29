@extends('layouts.app')

@section('title')
    Article
@endsection

@section('content')
<div class="col-sm-8 blog-main">
	<div class="blog-post">
		<div class="blog-text-border">
			<h2 class="blog-post-title">{{ $post->title }}</h2>
			<p class="blog-post-meta">
				<small><i>{{ Carbon\Carbon::parse($post->created_at)->format('l jS \of F Y') }} 
					by <a href="#">{{ $author }}</a></i></small></p>
			<hr />
			<p class="text-justify">
				{!! nl2br(e($post->description)) !!}
			</p>
		</div>
	</div>
	@auth
	<div style="margin-bottom:20px;">
		<div class="blog-text-border">
			<textarea class="form-control" rows="3" name="body" id="body" onkeyup="success()" placeholder="Leave a comment" v-model="commentBox"></textarea>
			<div style="margin-top:10px" v-if="loading">
            	<i class="fas fa-spinner fa-spin" style="font-size:24px"></i>
        	</div>
        	<div v-else>
				<button class="btn btn-success" id="button" disabled="true" style="margin-top:10px" @click.prevent="postComment">Save Comment</button>
			</div>
		</div>
	</div>
	@else
	<div class="blog-text-border">
		<p class="lead text-center">You must be logged in to submit a comment.&nbsp;<a href="/login">Login Now &gt;&gt;</a></p>
	</div>
	@endauth
	<div v-if="comments[0]">
		<div class="blog-text-border">
			<p class="lead"><b>@{{comments.length}} thought(s) on "{{ $post->title }}"</b></p>
			<hr />
			<div class="media" style="margin-top:20px;" v-for="comment in comments">
			    <div class="media-left" style="padding-right: 20px;">
			        <a href="#">
			            <img class="media-object" v-bind:src="'/storage/avatars/' + comment.user.avatar" alt="...">
			        </a>
			    </div>
			    <div class="media-body">
			        <h4 class="media-heading">@{{comment.user.name}} said...</h4>
			        <p>
			          @{{comment.body}}
			        </p>
			        <span style="color: #aaa;">on @{{comment.updated_at}}</span><br />
			    </div>
			    @auth
			    <div v-if="user.id == comment.user.id">
			    <div class="media-right">
			    	<div class="dropdown">
			    		<a href="#" class="btn btn-default" data-toggle="dropdown">
			    			<i class="fas fa-ellipsis-v"></i>
			    		</a>
			    	
			    		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
			    			<a class="dropdown-item" @click.prevent="editComment(comment.body,comment.id)">Edit</a>
			        		<a class="dropdown-item" @click.prevent="deleteComment(comment.id)">Delete</a>
			    		</div>
			    	</div>
			    </div>
			</div>
			    @endauth
			</div>
		</div>
	</div>
	<div class="blog-text-border" v-else>
		<p class="lead text-center">Be the first to leave a comment!</p>
	</div>
</div>

<aside class="col-sm-4 ml-sm-auto blog-sidebar">
	<div class="blog-text-border">
		<div class="sidebar-module">
		    <h2 class="blog-post-title">Recent Posts</h2>
		    <p class="blog-post-meta">
				<small>Today is&nbsp;<i>{{ date('l jS \of F Y') }}</i></small></p>
			<hr />
		    <ol class="list-unstyled">
		        @foreach($articles as $article)
		            <li><a href="{{ url('blog', [$article->slug]) }}">{{ $article->title }}</a> 
		            	posted on <i>{{ Carbon\Carbon::parse($article->created_at)->format('l jS \of F Y') }}</i></li>
		        @endforeach
		    </ol>
		</div>
		<div class="sidebar-module">
		    <h4>Elsewhere</h4>
		    <ol class="list-unstyled">
		        <li><a href="#">GitHub</a></li>
		        <li><a href="#">Twitter</a></li>
		        <li><a href="#">Facebook</a></li>
		    </ol>
		</div>
	</div>
</aside>
@endsection

@section('scripts')
<script>
	const app = new Vue({
		el: '#app',
		data: {
			comments: {},
			commentBox: '',
			post: {!! $post->toJson() !!},
			user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!},
			loading: false
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
					console.log(error.response);
					swal({
					  title: 'Error!',
					  text: error.response.data.errors.body,
					  type: 'error',
					  confirmButtonText: 'Ok'
					})
				});
			},
			postComment() {
				this.loading = true;
				axios.post('/api/article/'+this.post.id+'/comment', {
					api_token: this.user.api_token,
					body: this.commentBox
				})
				.then((response) => {
					this.loading = false;
					this.comments.unshift(response.data);
					this.commentBox = '';
				})
				.then(function() {
					swal({
					  toast: true,
					  position: 'top-end',
					  showConfirmButton: false,
					  timer: 3000,
					  type: 'success',
					  title: 'Post Successful'
					});
				})
				.catch((error) => {
					this.loading = false;
					console.log(error.response);
					swal({
					  title: 'Error!',
					  text: error.response.data.errors.body,
					  type: 'error',
					  confirmButtonText: 'Ok'
					})
				})
			},
			editComment: function (message,id) {
				swal({
				  input: 'textarea',
				  inputValue: message,
				  confirmButtonText: 'Update Comment',
				  inputPlaceholder: 'Type your message here',
				  showCancelButton: true,
				  showLoaderOnConfirm: true,
				  closeOnConfirm: false
				}).then((result) => {
					if (result.value) {
						axios.post('/api/article/'+this.post.id+'/comment/'+id+'/update', {
							api_token: this.user.api_token,
							body: result.value,
							comment_id: id
						})
						.then((response) => {
							this.getComments();
						})
						.then(function() {
							swal({
								title: 'Post updated!',
								type: 'success',
								showConfirmButton: false,
								timer: 1500
							})
						})
						.catch((error) => {
							console.log(error.response);
							swal({
							  title: 'Error!',
							  text: error.response.data.errors.body,
							  type: 'error',
							  confirmButtonText: 'Ok'
							})
						})
					}
				})
			},
			deleteComment: function(id) {
				swal({
		          title: "Are you sure want to remove this comment?",
		          text: "You will not be able to recover this item",
		          type: "warning",
		          showCancelButton: true,
		          confirmButtonClass: "btn-danger",
		          confirmButtonText: "Confirm",
		          cancelButtonText: "Cancel",
		          closeOnConfirm: false,
		          closeOnCancel: false
		        }).then((result) => {
		          	if (result.value) {
			            axios.post('/api/article/'+this.post.id+'/comment/'+id+'/delete', {
							api_token: this.user.api_token,
							comment_id: id
						})
						.then((response) => {
							this.getComments();
						})
						.then(function() {
							swal({
								title: 'Post deleted!',
								type: 'success',
								showConfirmButton: false,
								timer: 1500
							})
						})
						.catch((error) => {
							console.log(error.response);
							swal({
							  title: 'Error!',
							  text: error.response.data.errors.body,
							  type: 'error',
							  confirmButtonText: 'Ok'
							})
						})
		      		}
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
	function success() {
		if(document.getElementById("body").value==="") { 
			document.getElementById('button').disabled = true; 
		} else { 
			document.getElementById('button').disabled = false;
		}
	}
</script>
@endsection