@extends('layout')

@section('title', $document->title)

@section('content')
  <article class="prose prose-zinc 2xl:prose-lg dark:prose-invert prose-a:text-red-700 prose-pre:overflow-auto prose-code:bg-transparent max-w-none mb-16">
    <header class="mb-4">
      <h1 class="text-2xl mb-2">{{ $document->title }}</h1>
      <p>{{ $document->date->format('F jS, Y') }}</p>
    </header>

    {!! $document->content !!}
  </article>

  @if($document->series)
  <div class="overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-600 mb-16">
    <div class="px-4 py-5 sm:p-6">
      <h2 class="text-xl">More in this series:</h2>
      <ul role="list" class="mt-4 list-inside list-disc text-lg/8">
        @foreach ($series[$document->series] as $post)
            @if (route('article', $document->slug) == $post['link'])
            <li class="">
              {{ $post['title']}}
            </li>
            @else
            <li class="">
              <a href="{{ $post['link'] }}" class="text-red-800 underline">{{ $post['title']}}</a>
            </li>
            @endif
          @endforeach
      </ul>
    </div>
  </div>
  @endisset
@endsection

@section('og')
  <!-- Meta / Open Graph -->
  <meta property="og:title" content="{{ $document->title }}" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="{{ route('article', $document->slug) }}" />
  <meta property="og:image" content="https://stagerightlabs.com/img/compact.png" />
  <meta property="og:image:width" content="500" />
  <meta property="og:image:height" content="500" />
  <meta property="og:description" content="{{ $document->summary }}" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:site_name" content="Stage Right Labs" />
  <meta property="og:article:published_time" content="{{ $document->date->format('c') }}">
  <meta property="og:article:author" content="Ryan C. Durham">
  <link rel="canonical" href="{{ route('article', $document->slug) }}" />
@endsection
