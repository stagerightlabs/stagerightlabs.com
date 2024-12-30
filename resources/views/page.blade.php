@extends("layout")

@section("title", $document->title)

@section("content")
  <article
    class="prose prose-zinc mb-16 max-w-none 2xl:prose-lg dark:prose-invert prose-a:text-red-700 prose-code:bg-transparent prose-pre:overflow-auto"
  >
    <header class="mb-4">
      <h1 class="mb-2 text-2xl">{{ $document->title }}</h1>
    </header>

    {!! $document->content !!}
  </article>
@endsection

@section("og")
  <!-- Meta / Open Graph -->
  <meta property="og:title" content="{{ $document->title }}" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="{{ route("article", $document->slug) }}" />
  <meta
    property="og:image"
    content="https://stagerightlabs.com/img/compact.png"
  />
  <meta property="og:image:width" content="500" />
  <meta property="og:image:height" content="500" />
  <meta property="og:description" content="{{ $document->summary }}" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:site_name" content="Stage Right Labs" />
  <link rel="canonical" href="{{ route("article", $document->slug) }}" />
@endsection
