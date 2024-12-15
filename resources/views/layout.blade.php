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

    @hasSection('og')
      <!-- Open Graph -->
      @yield('og')
    @endif

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('icon/site.webmanifest') }}">

    <!-- Feed -->
    <link rel="alternate" type="text/xml" href="#" title="Stage Right Labs">

    <!-- Umami -->
    {{-- <script async deferg
      data-website-id="55bf85af-d593-4ee1-aede-d3a887b4a1d5"
      src="https://umami.stagerightlabs.com/script.js"
      data-do-not-track="true"
    ></script> --}}
    @vite('resources/app.css')
  </head>
  <body class="bg-zinc-50 text-zinc-600 dark:bg-zinc-900 dark:text-zinc-200 xl:flex justify-between container mx-auto relative">
    <main class="xl:pr-8 py-8 2xl:max-w-screen-lg xl:max-w-screen-md">
      @yield('content')
    </main>
    <aside class="lg:w-96 lg:mx-auto xl:mx-0">
      <svg
          class="mx-auto"
          version="1.0" xmlns="http://www.w3.org/2000/svg"
          width="250px"
          height="250px"
          viewBox="0 0 5000 5000" preserveAspectRatio="xMidYMid meet">
          <title>Stage Right Labs Logo</title>
          <g id="brackets" stroke="none">
          <path class="fill-zinc-400 dark:fill-zinc-300" d="M1005 4013 c-86 -12 -203 -47 -266 -78 -119 -61 -198 -146 -242 -264 -19 -52 -21 -84 -27 -426 -5 -318 -9 -376 -23 -415 -42 -107 -150 -168 -329 -185 l-68 -7 0 -123 0 -124 48 -6 c164 -20 226 -42 290 -99 72 -66 75 -82 82 -501 5 -352 7 -373 28 -426 49 -123 113 -191 242 -258 94 -49 220 -81 332 -84 l83 -2 0 125 0 125 -65 6 c-82 9 -174 41 -220 77 -19 15 -48 55 -65 87 l-30 60 -5 355 c-5 335 -7 358 -28 410 -43 110 -145 194 -272 227 -39 9 -70 21 -70 25 0 3 26 14 58 23 136 40 230 113 279 219 l28 61 5 365 5 365 27 57 c43 91 122 138 273 161 l80 12 0 120 0 120 -60 1 c-33 1 -73 -1 -90 -3z"/>
          <path class="fill-zinc-400 dark:fill-zinc-300" d="M3850 3898 c0 -138 0 -138 63 -138 84 0 213 -55 258 -109 55 -67 59 -96 59 -420 0 -163 5 -325 11 -361 28 -176 139 -292 317 -331 58 -13 66 -25 25 -35 -133 -29 -226 -85 -282 -171 -60 -91 -63 -113 -70 -508 -6 -346 -7 -362 -28 -401 -48 -89 -145 -142 -290 -159 l-63 -7 0 -125 0 -126 94 7 c298 21 499 147 568 356 20 60 22 92 27 435 l6 370 27 52 c49 91 130 134 293 155 l95 11 0 123 0 123 -32 5 c-18 3 -56 8 -84 11 -138 15 -229 66 -271 153 l-28 57 -6 365 c-5 339 -7 370 -27 431 -68 204 -274 332 -576 355 l-86 7 0 -125z"/>
          </g>
          <g id="flask" stroke="none" class="fill-red-900">
              <path d="M1663 3645 c-55 -24 -78 -81 -58 -145 4 -14 148 -295 319 -625 l311 -600 3 -392 3 -392 -28 -13 c-20 -9 -29 -22 -31 -44 -6 -61 52 -82 248 -91 142 -6 288 7 346 32 22 9 36 23 40 41 6 23 2 32 -24 54 l-32 26 0 387 0 386 316 612 c219 423 318 625 321 653 6 49 -22 91 -73 112 -49 21 -1614 20 -1661 -1z m1217 -890 c0 -4 -7 -19 -15 -35 -14 -28 -19 -29 -86 -32 -55 -2 -74 -7 -83 -20 -19 -31 4 -52 62 -58 l51 -5 -54 -100 -54 -100 -67 -5 c-49 -4 -70 -10 -78 -22 -19 -30 4 -53 58 -56 40 -3 47 -6 41 -20 -4 -9 -9 -61 -12 -114 l-6 -98 -51 0 c-57 0 -76 -12 -76 -47 0 -29 27 -43 84 -43 l46 0 0 -115 0 -115 -46 0 c-58 0 -84 -14 -84 -45 0 -31 26 -45 84 -45 l46 0 0 -95 0 -95 -145 0 -144 0 -3 405 -3 406 -112 219 c-62 121 -113 224 -113 230 0 7 123 10 380 10 209 0 380 -2 380 -5z"/>
          </g>
      </svg>
      <h2 class="text-center text-3xl pb-4">Stage Right Labs</h2>
      <nav class="flex flex-1 flex-col mt-8 lg:mt-0 p-2 mb-4" aria-label="Sidebar">
        <ul role="list" class="space-y-1 text-xl">
          <li>
            <!-- Current: "bg-zinc-50 text-red-600", Default: "text-zinc-700 hover:text-red-600 hover:bg-zinc-50" -->
            <a href="{{ route('home') }}" class="group flex gap-x-3 rounded-md p-2 pl-3 font-semibold {{ Route::is('home') || Route::is('article') ? 'text-red-800 bg-zinc-400 dark:bg-zinc-300' : 'text-zinc-600 hover:bg-zinc-400 hover:text-red-800' }}">Articles</a>
          </li>
          <li>
            <a href="{{ route('projects') }}" class="group flex gap-x-3 rounded-md p-2 pl-3 font-semibold {{ Route::is('projects') ? 'text-red-800 bg-zinc-400 dark:bg-zinc-300' : 'text-zinc-600 hover:bg-zinc-400 hover:text-red-800' }}">Open Source</a>
          </li>
          <li>
            <a href="{{ route('decks.index') }}" class="group flex gap-x-3 rounded-md p-2 pl-3 font-semibold {{ Route::is('decks.index') ? 'text-red-800 bg-zinc-400 dark:bg-zinc-300' : 'text-zinc-600 hover:bg-zinc-400 hover:text-red-800' }}">Decks</a>
          </li>
          <li>
            <a href="{{ route('resume') }}" class="group flex gap-x-3 rounded-md p-2 pl-3 font-semibold {{ Route::is('resume') ? 'text-red-800 bg-zinc-400 dark:bg-zinc-300' : 'text-zinc-600 hover:bg-zinc-400 hover:text-red-800' }}">Resume</a>
          </li>
          <li>
            <a href="{{ route('about') }}" class="group flex gap-x-3 rounded-md p-2 pl-3 font-semibold {{ Route::is('about') ? 'text-red-800 bg-zinc-400 dark:bg-zinc-300' : 'text-zinc-600 hover:bg-zinc-400 hover:text-red-800' }}">About</a>
          </li>
        </ul>
      </nav>
      <div class="flex justify-around p-2">
        {{-- https://lucide.dev/icons/github --}}
        <a href="https://github.com/stagerightlabs/" target="_blank" class="group flex gap-x-3 rounded-md w-1/3 p-2 text-sm/6 font-semibold text-zinc-600 hover:bg-zinc-500 hover:text-red-800">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-auto" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-github"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>
        </a>
        {{-- https://lucide.dev/icons/linkedin --}}
        <a href="https://www.linkedin.com/in/rydurham/" target="_blank" class="group flex gap-x-3 rounded-md w-1/3 p-2 text-sm/6 font-semibold text-zinc-600 hover:bg-zinc-500 hover:text-red-800">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-auto" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
        </a>
        {{-- https://lucide.dev/icons/rss --}}
        <a href="{{ route('feed') }}" class="group flex gap-x-3 rounded-md w-1/3 p-2 text-sm/6 font-semibold text-zinc-600 hover:bg-zinc-500 hover:text-red-800">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-auto" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rss"><path d="M4 11a9 9 0 0 1 9 9"/><path d="M4 4a16 16 0 0 1 16 16"/><circle cx="5" cy="19" r="1"/></svg>
        </a>
      </div>
    </aside>

    @stack('scripts')
    @env('local')
      @include('break-points')
    @endenv
    @vite('resources/app.js')
  </body>
</html>
