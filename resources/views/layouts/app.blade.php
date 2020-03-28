<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')

    @stack('styles')
</head>
<body>
    <div id="app">

        @guest
        @else
            @if (Auth::user()->passed_register)
                @include('includes.sidebar')
                @include('includes.header')
                @include('includes.popup')
            @endif 
        @endguest

        <main>
            @yield('content')
        </main>

        @guest
        @else
            @include('includes.popup')
        @endguest
        
    </div>
</body>

@include('includes.script')
@include('includes.global-js')

@stack('scriptsAfter')

</html>
