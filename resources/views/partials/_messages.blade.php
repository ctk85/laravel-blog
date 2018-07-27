<div class="container">
    @if($errors->any())
    <div id="ERROR_COPY" style="display: none;" class="alert alert-danger">
        @foreach ($errors->all() as $error)
            &#9888;&nbsp;{{ $error }}<br />
        @endforeach
        </div>
    @endif

    @if(session('success'))
    	<div id="SUCCESS_COPY" style="display: none;" class="alert alert-success">
    		{{ session('success') }}
    	</div>
    @endif
</div>

@section('scripts')
<script type="text/javascript">
    var has_errors = {{ $errors->count() > 0 ? 'true' : 'false' }};
    var has_success = {{ session('success') ? 'true' : 'false' }};

    if ( has_errors ) {
        swal({
            title: 'Oops...',
            type: 'error',
            html: jQuery("#ERROR_COPY").html(),
            showCloseButton: true,
        });
    }
    if ( has_success ) {
        swal({
          position: 'top-end',
          type: 'success',
          title: jQuery("#SUCCESS_COPY").text(),
          showConfirmButton: false,
          timer: 2000
        });
    }
</script>
@endsection