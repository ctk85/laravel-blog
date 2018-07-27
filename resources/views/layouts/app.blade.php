<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Head -->
@include('partials._head')

<body>
    <div id="app">
        
        @include('partials._header') 
        @include('partials._messages')
        @include('sweetalert::alert')

        <main role="main" class="container">
            <div class="row">
                
                @yield('content')

                @if(Request::is('home','/'))
                    @include('partials._sidebar')
                @endif

            </div>
        </main>

        @include('partials._footer')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>