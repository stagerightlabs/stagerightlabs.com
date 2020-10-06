<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  @hasSection('title')
    <title>@yield('title') - {{ config('app.name') }}</title>
  @else
    <title>{{ config('app.name') }}</title>
  @endif

  @hasSection('meta')
    <!-- Meta / Open Graph -->
    @yield('meta')
  @endif

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url(asset('icon/apple-touch-icon.png')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url(asset('icon/favicon-32x32.png')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url(asset('icon/favicon-16x16.png')) }}">
    <link rel="manifest" href="{{ url(asset('icon/site.webmanifest')) }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
    @livewireStyles

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Umami -->
    <script async defer
      data-website-id="55bf85af-d593-4ee1-aede-d3a887b4a1d5"
      src="https://umami.stagerightlabs.com/umami.js"
      data-do-not-track="true"
    ></script>
  </head>
  <body class="bg-repeat bg-gray-900 text-cool-gray-300" style="background-image: url(/img/stressed-linen.png)">
    {{ $slot }}
    <script src="{{ url(mix('js/app.js')) }}"></script>
    @livewireScripts
  </body>
</html>