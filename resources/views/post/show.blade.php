@extends('layouts.app')

@section('title')
  
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card border-dark mb-3">
                <div class="card-header">
                  {{ $post->title }}
                </div>
                <div class="card-body text-dark">
                    <p class="card-text text-justify">
                        {!! nl2br(e($post->description)) !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-primary mb-3">
                <div class="card-header">Post Details</div>
                <div class="card-body text-dark">
                    <dl class="row">
                        <dt class="col-sm-5">URL:</dt>
                        <dd class="col-sm-7"><a href="{{ URL::to("/blog/{$post->slug}") }}">{{ URL::to("/blog/{$post->slug}") }}</a></dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-5">Created At:</dt>
                        <dd class="col-sm-7">{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-5">Updated At:</dt>
                        <dd class="col-sm-7">{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-6">
                            {!! Html::linkRoute('post.edit', 'Edit Post', ['id' => $post->id], ['class' => 'btn btn-info btn-sm form-control']) !!}
                        </dt>
                        <dt class="col-sm-6"> 
                            {!! Form::open(['route' => ['post.destroy', 'id' => $post->id], 'id' => 'form1', 'method' => 'POST']) !!}
                                @csrf
                                @method('DELETE')
                                {{ Form::submit('Delete Post', ['class' => 'btn btn-danger btn-sm form-control']) }}
                            {!! Form::close() !!}
                        </dt>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-12">
                            {!! Html::linkRoute('post.index-admin', '<< See all posts', null, ['class' => 'btn btn-warning btn-sm form-control']) !!}
                        </dt>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    document.querySelector('#form1').addEventListener('submit', function(e) {
        var form = document.getElementById("form1");

  e.preventDefault(); // <--- prevent form from submitting

  swal({
      title: "Are you sure want to remove this blog post?",
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
        swal({
          title: "Deleted!",
          text: "The post has been deleted",
          type: "success"
      }).then(function() {
        form.submit();
    });
  }
})
});
</script>

@endsection