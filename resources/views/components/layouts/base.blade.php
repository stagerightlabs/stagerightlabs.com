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
    <link
      rel="icon"
      type="image/svg+xml"
      href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22256%22 height=%22256%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%2364748b%22></rect><path fill=%22%239b1c1c%22 d=%22M43.52 35.34L36.70 35.34Q36.19 31.02 32.56 28.64Q28.92 26.25 23.64 26.25L23.64 26.25Q19.77 26.25 16.89 27.50Q14.01 28.75 12.40 30.94Q10.80 33.13 10.80 35.91L10.80 35.91Q10.80 38.24 11.92 39.90Q13.04 41.56 14.80 42.66Q16.56 43.75 18.49 44.45Q20.43 45.14 22.05 45.57L22.05 45.57L27.95 47.16Q30.23 47.76 33.03 48.81Q35.82 49.86 38.39 51.66Q40.97 53.47 42.64 56.28Q44.32 59.09 44.32 63.18L44.32 63.18Q44.32 67.90 41.86 71.70Q39.40 75.51 34.70 77.76Q30 80 23.30 80L23.30 80Q17.05 80 12.49 77.98Q7.93 75.97 5.33 72.36Q2.73 68.75 2.39 63.98L2.39 63.98L9.66 63.98Q9.94 67.27 11.89 69.42Q13.84 71.56 16.83 72.60Q19.83 73.64 23.30 73.64L23.30 73.64Q27.33 73.64 30.54 72.32Q33.75 70.99 35.63 68.62Q37.50 66.25 37.50 63.07L37.50 63.07Q37.50 60.17 35.88 58.35Q34.26 56.53 31.62 55.40Q28.98 54.26 25.91 53.41L25.91 53.41L18.75 51.36Q11.93 49.40 7.95 45.77Q3.98 42.13 3.98 36.25L3.98 36.25Q3.98 31.36 6.63 27.71Q9.29 24.06 13.79 22.03Q18.30 20 23.86 20L23.86 20Q29.49 20 33.86 22.00Q38.24 24.01 40.81 27.47Q43.38 30.94 43.52 35.34L43.52 35.34ZM62.95 78.98L55.91 78.98L55.91 20.80L75.57 20.80Q82.39 20.80 86.76 23.11Q91.14 25.43 93.24 29.46Q95.34 33.49 95.34 38.64L95.34 38.64Q95.34 43.78 93.24 47.76Q91.14 51.73 86.79 53.99Q82.44 56.25 75.68 56.25L75.68 56.25L59.77 56.25L59.77 49.89L75.45 49.89Q80.11 49.89 82.97 48.52Q85.82 47.16 87.12 44.64Q88.41 42.13 88.41 38.64L88.41 38.64Q88.41 35.14 87.10 32.53Q85.80 29.91 82.93 28.48Q80.06 27.05 75.34 27.05L75.34 27.05L62.95 27.05L62.95 78.98ZM75.34 52.84L83.30 52.84L97.61 78.98L89.43 78.98L75.34 52.84Z%22></path></svg>"
    />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
    @livewireStyles

    <!-- Feed -->
    <link rel="alternate" type="text/xml" href="{{ route('feed') }}" title="Stage Right Labs">

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

    @env('local')
      <x-break-points />
    @endenv
  </body>
</html>
