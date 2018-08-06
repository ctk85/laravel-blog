@extends('layouts.app')

@section('title')
    Article
@endsection

@section('content')
<div class="row">
<div class="col-sm-9 blog-main" style="margin-bottom:20px;">
	<div class="blog-post">
		<div class="card mb-3">
			<div class="card-body">
				<h2 class="blog-post-title">{{ $post->title }}</h2>
				<p class="blog-post-meta">
					<small><i>{{ Carbon\Carbon::parse($post->created_at)->format('l jS \of F Y') }} 
						by <a href="#">{{ $post->user->name }}</a></i></small></p>
				<hr />
				<p class="text-justify">
					{!! nl2br(e($post->description)) !!}
				</p>
				<i class="fas fa-thumbs-up">&nbsp;</i>@{{ getlikes.length }}
                <div class="tags">
                  @foreach($post->tags as $tag)
                    <span class="badge badge-secondary">{{ $tag->name }}</span>
                  @endforeach
                </div>
                @auth
                <hr>
        		<div class="text-center">
			        <div v-if="isLiked" @click.prevent="unLike(post)">
			            <a href="#"><i class="fas fa-thumbs-up fa-2x"></i></a>
			            <b><font color="#aaa">Liked!</font></b>
			      	</div>
			      	<div v-else @click.prevent="like(post)">
			            <a href="#"><i style="color:#aaa;" class="far fa-thumbs-up fa-2x"></i></a>
			            <b><font color="#aaa">Like</font></b>
			        </div>
		    	</div>
                @endauth
			</div>
		</div>
	</div>
	@auth
	<div style="margin-bottom:20px;">
		<div class="card mb3">
			<div class="card-body">
				<textarea class="form-control" rows="3" name="body" id="body" onkeyup="success()" placeholder="Leave a comment" v-model="commentBox"></textarea>
				<div style="margin-top:10px" v-if="loading">
	            	<i class="fas fa-spinner fa-spin" style="font-size:24px"></i>
	        	</div>
	        	<div v-else>
					<button class="btn btn-success" id="button" disabled="true" style="margin-top:10px" @click.prevent="postComment">Save Comment</button>
				</div>
			</div>
		</div>
	</div>
	@else
	<div class="blog-text-border">
		<p class="lead text-center">You must be logged in to submit a comment.&nbsp;<a href="/login">Login Now &gt;&gt;</a></p>
	</div>
	@endauth
	<div v-if="comments[0]">
		<div class="card mb3">
			<div class="card-body">
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
			        <span style="color: #aaa;">on @{{comment.created_at}}</span><br />
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
	</div>
	<div class="card mb-3" v-else>
		<div class="card-body">
			<p class="lead text-center">Be the first to leave a comment!</p>
		</div>
	</div>
</div>

@include('partials._sidebar')
</div>
@endsection

@section('scripts')
<script>
	const app = new Vue({
		el: '#app',
		data: {
			comments: {},
			getlikes: {},
			commentBox: '',
			post: {!! $post->toJson() !!},
			user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!},
			loading: false,
			isLiked: {!! $isLiked ? 'true' : 'false' !!},
		},
		mounted() {
			this.getComments();
			this.getLikes();
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
					this.loading = true;
					if (result.value) {
						axios.post('/api/article/'+this.post.id+'/comment/'+id+'/update', {
							api_token: this.user.api_token,
							body: result.value,
							comment_id: id
						})
						.then((response) => {
							this.loading = false;
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
							this.loading = false;
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
				});
			},
			getLikes() {
				axios.get('/api/article/'+this.post.id+'/getlikes')
				
				.then((response) => {
					this.getlikes = response.data
				})
                .catch(response => console.log(response.data));
			},
			like() {
                axios.post('/api/article/'+this.post.id+'/like', {
                	api_token: this.user.api_token,
                })
                .then((response) => { 
                	this.isLiked = true;
                	this.getlikes.unshift(response.data);
				})
                .catch(response => console.log(response.data));
            },
            unLike() {
                axios.post('/api/article/'+this.post.id+'/unLike', {
                	api_token: this.user.api_token,
                })
                .then((response) => { 
                	this.isLiked = false;
                	this.getlikes.shift(response.data);
				})
                .catch(response => console.log(response.data));
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