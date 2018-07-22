@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <p></p>
        <ul>
            @foreach ($errors->all() as $error)
                &#9888;&nbsp;{{ $error }}<br/>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
	</div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{session('info')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif