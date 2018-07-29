<aside class="col-sm-3 ml-sm-auto blog-sidebar">
    <div class="blog-text-border">
    <div class="sidebar-module">
        <h4>Recent Posts</h4>
        <ol class="list-unstyled">
            @foreach($articles as $article)
                <li><a href="{{ url('blog', [$article->slug]) }}">{{ $article->title }}</a></li>
            @endforeach
        </ol>
    </div>
    @if(Request::is('home','/'))
    <div class="sidebar-module">
        <h4>Archive</h4>
        <ol class="list-unstyled">
            @foreach($months as $month)
                <li><a href="{{ URL::to('?filter=' . Carbon\Carbon::parse($month)->format('Y-m')) }}">{{ $month }}</a></li>
            @endforeach
        </ol>
    </div>
    @else
    <div class="sidebar-module">
        <h4>Archive</h4>
        <ol class="list-unstyled">
            @foreach($months as $month)
                <li><a href="{{ URL::to('/?filter=' . Carbon\Carbon::parse($month)->format('Y-m')) }}">{{ $month }}</a></li>
            @endforeach
        </ol>
    </div>
    @endif
    <div class="sidebar-module">
        <h4>Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
        </ol>
    </div>
</div>
</aside><!-- /.blog-sidebar -->