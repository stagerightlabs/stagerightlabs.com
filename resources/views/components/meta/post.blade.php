      <meta property="og:title" content="{{ $post->title }}" />
      <meta property="og:type" content="article" />
      <meta property="og:url" content="{{ $post->url }}" />
      <meta property="og:image" content="{{ url(asset('img/compact.png')) }}" />
      <meta property="og:image:width" content="500" />
      <meta property="og:image:height" content="500" />
      <meta property="og:description" content="{{ $post->description }}" />
      <meta property="og:locale" content="en_US" />
      <meta property="og:site_name" content="Stage Right Labs" />
      <meta property="og:article:published_time" content="{{ $post->published_at->toIso8601String() }}">
      <meta property="og:article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">
      <meta property="og:article:author" content="Ryan C. Durham">
      <meta property="og:article:section" content="Technology">
      @foreach ($post->tags as $tag)
      <meta property="og:article:tag" content="{{ $tag->name }}">
      @endforeach
      <link rel="canonical" href="{{ $post->url }}" />
