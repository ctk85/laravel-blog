<aside class="col-sm-3 ml-sm-auto blog-sidebar">
    
    @auth
        <h4>Manage Posts</h4>
        <div class="sidebar-module">
            <ol class="list-unstyled">
                @if(auth()->user()->isAdmin == 1)
                   <li><a href="{{ route('post.index-admin') }}"><button style="width: 100px" class="btn btn-sm btn-secondary">All Posts&nbsp;&gt;&gt;</button></a></li>
                @endif
                <li><a href="{{ route('post.index') }}"><button style="width: 100px"class="btn btn-sm btn-primary">My Posts&nbsp;&gt;&gt;</button></a></li>
            </ol>
        </div>
    @endauth

    <div class="sidebar-module">
        <h4>Latest Posts</h4>
        <ol class="list-unstyled">
            @foreach($months as $month)
                <li><a href="{{ URL::to('?filter=' . Carbon\Carbon::parse($month)->format('Y-m')) }}">{{ $month }}</a></li>
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
</aside><!-- /.blog-sidebar -->