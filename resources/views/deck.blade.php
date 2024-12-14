<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  @hasSection('title')
    <title>@yield('title') - {{ config('app.name') }}</title>
  @else
    <title>{{ config('app.name') }}</title>
  @endif

  <!-- favicon -->
  <link rel="shortcut icon" href="../favicon.ico">
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ url(asset('icon/apple-touch-icon.png')) }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ url(asset('icon/favicon-32x32.png')) }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ url(asset('icon/favicon-16x16.png')) }}">
  <link rel="manifest" href="{{ url(asset('icon/site.webmanifest')) }}">

  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

  <!-- Deck Styles -->
  <link rel="stylesheet" href="{{ url(asset('css/reveal.css')) }}">
  <link rel="stylesheet" href="{{ url(asset('css/deck-theme.css')) }}" id="theme">

  <!-- Syntax highlighting -->
  <link rel="stylesheet" href="{{ url(asset('css/highlight.css')) }}">

</head>

<body>
  <div id="logo">
    <a href="/"><img src="{{ url(asset('img/deck_logo.png')) }}" alt="Stage Right Labs Logo" /></a>
  </div>


  <div class="reveal">
    <!-- Wrap all slides in a single "slides" class -->
    <div class="slides">

      <!-- ALL SLIDES GO HERE -->
      <!-- Each section element contains an individual slide -->
      @yield('slides')

    </div>
  </div>
  <script src="{{ url(asset('js/reveal.js')) }}"></script>

  <script>
    Reveal.initialize({
      controls: true,
      history: true,
      transition: 'fade',
      controlsTutorial: false,

      dependencies: [
        { src: "{{ url(asset('js/highlight.js')) }}", async: true },
      ]
    });
  </script>
</body>

</html>
