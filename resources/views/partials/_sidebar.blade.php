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
            <li><a href="#">March 2017</a></li>
            <li><a href="#">February 2017</a></li>
            <li><a href="#">January 2017</a></li>
            <li><a href="#">December 2013</a></li>
            <li><a href="#">November 2013</a></li>
            <li><a href="#">October 2013</a></li>
            <li><a href="#">September 2013</a></li>
            <li><a href="#">August 2013</a></li>
            <li><a href="#">July 2013</a></li>
            <li><a href="#">June 2013</a></li>
            <li><a href="#">May 2013</a></li>
            <li><a href="#">April 2013</a></li>
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