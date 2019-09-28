<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}'}</script>
    <title>{{ config('app.name', 'Art Discovery') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animations-extended.css') }}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{asset('icon.png')}}">
    <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/vis-timeline-graph2d.min.css') }}">
    <script src="{{ asset('js/vis-timeline-graph2d.min.js') }}"></script>
    <script src="{{ asset('js/jscolor.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/waves.js') }}"></script>
</head>

<body>
    <div id="app">

        @include('includes.navbar')
        <main>
            @yield('content')
        </main>
        <div id='scroll-to-top' class='btn btn-lg btn-success'><i class="fas fa-angle-double-up"></i></div>
    </div>
    {{-- @auth --}}
        {{-- @if(Auth::user()->type !== 'admin') --}}
            <script>
                var assets = '{{ asset("img/pleasepurchase.png") }}';
            </script>
            <script src="{{ asset('js/videos.js') }}"></script>
        {{-- @endif --}}
    {{-- @else --}}
        {{-- <script src="{{ asset('js/videos.js') }}"></script> --}}
    {{-- @endauth --}}

    @include('includes.footer')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <script src="{{ asset('js/video-scrollers.js') }}" ></script>
</body>
</html>
