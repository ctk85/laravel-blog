<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('partials._head')

<body>
    <div id="app">
        
        @include('partials._header') 
        
        <div class="container">
            @include('partials._messages')
        </div>
        
        <main role="main" class="container">
            <div class="row">
                
                @yield('content')

                @if(Request::is('home','/'))
                    @include('partials._sidebar')
                @endif

            </div>
        </main>

        @include('partials._footer')
        @yield('scripts')
        
    </div>
</body>
</html>
