      @hasSection('title')
        <meta property="og:title" content="@yield('title')" />
      @endif
      <meta property="og:type" content="website" />
      <meta property="og:image" content="{{ url(asset('img/compact.png')) }}" />
      <meta property="og:image:width" content="500" />
      <meta property="og:image:height" content="500" />
      <meta property="og:locale" content="en_US" />
      <meta property="og:site_name" content="Stage Right Labs" />
