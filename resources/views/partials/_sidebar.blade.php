<aside class="col-sm-3 ml-sm-auto blog-sidebar">
    
    @auth
        <h4>Manage Posts</h4>
        <div class="sidebar-module">
        @if(auth()->user()->isAdmin == 1)
        <a href="{{ route('post.index-admin') }}">
            <button type="button" class="btn btn-primary btn-sm">All Posts</button>
        </a>
        @endif

        @auth
            <a href="{{ route('post.index') }}">
                <button type="button" class="btn btn-info btn-sm">My Posts</button>
            </a>
        @endauth
        <p></p>
        </div>
    @endauth

    <div class="sidebar-module">
        <h4>Latest Posts</h4>
        <ol class="list-unstyled">
            @foreach($months as $month)
                <li><a href="#">{{ $month }}</a></li>
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