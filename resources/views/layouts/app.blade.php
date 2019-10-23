<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
$v = mt_rand();
@endphp
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="ArtDiscovery, Art, Lectures, Armenian, Website, Armenia, History">
  <meta name="description" content="Lectures about History, Art and more">
  <meta name="copyright" content="ArtDiscovery">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta property="og:title" content="ArtDiscovery" />
  <meta property="og:description" content="Start discovering today!" />
  <meta property="og:image" content="https://artdiscovery.online/img/og-logo.png" />
  <meta property="og:url" content="https://artdiscovery.online/" />
  <meta property="og:site_name" content="ArtDiscovery" />
  <script>
    window.Laravel = {
      csrfToken: '{{ csrf_token() }}'
    }
  </script>
  <title>{{ config('app.name', 'Art Discovery') }}</title>
  <link href="{{ asset('css/app.css?v='.$v) }}" rel="stylesheet">
  <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/gijgo.css') }}" rel="stylesheet">
  <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/animations-extended.css') }}" rel="stylesheet" />
  <link rel="shortcut icon" href="{{asset('icon.png')}}">
  <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/vis-timeline-graph2d.min.css') }}">
  <script src="{{ asset('js/vis-timeline-graph2d.min.js') }}"></script>
  <script src="{{ asset('js/jscolor.js') }}"></script>
  <script src="{{ asset('js/main.js?v='.$v) }}"></script>
  <script src="{{ asset('js/waves.js') }}"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-32422407-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-32422407-3');
  </script>

</head>

<body>
  <div id="app">
    <div class="page-loader">
      <div class="spinner-grow text-primary" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
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
  <script src="{{ asset('js/app.js?v='.$v) }}" defer></script>
  <script>
    window.translations = {!! Cache::get('translations') !!}
  </script>
  <script src="{{ asset('js/video-scrollers.js') }}"></script>
  <script src="{{ asset('js/jquery.jscroll.min.js') }}" defer></script>
  @yield('scripts')


</body>

</html>
