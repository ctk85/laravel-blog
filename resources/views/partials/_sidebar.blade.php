<aside class="col-sm-3 ml-sm-auto blog-sidebar">
   <div class="card mb3">
    <div class="card-body">
    <div class="sidebar-module">
        <h4>Popular Posts</h4>
        <ol class="list-unstyled">
            @foreach($articlesPop as $articlePop)
                @if($articlePop->likes_count > 0)
                    <li><a href="{{ url('blog', [$articlePop->slug]) }}">{{ $articlePop->title }}</a>&nbsp;
                    <small class="text-muted"><i style="color:#aaa" class="fas fa-thumbs-up"></i>&nbsp;<font color="#aaa">{{ $articlePop->likes_count }}</font></small></li>
                @endif
            @endforeach
        </ol>
    </div>
    <div class="sidebar-module">
        <h4>Recent Posts</h4>
        <ol class="list-unstyled">
            @foreach($articles as $article)
                <li><a href="{{ url('blog', [$article->slug]) }}">{{ $article->title }}</a>
                    <small class="text-muted">{{ Carbon\Carbon::parse($article->created_at)->format('jS M') }}</small></li>
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
            <a href="#"><i class="fab fa-twitter-square fa-3x"></i></a>
            <a href="#"><i class="fab fa-github-square fa-3x"></i></a>
            <a href="#"><i class="fab fa-facebook-square fa-3x"></i></a>
            <a href="#"><i class="fab fa-google-plus-square fa-3x"></i></a>
        </ol>
    </div>
</div>
</div>
</div>
</aside><!-- /.blog-sidebar -->