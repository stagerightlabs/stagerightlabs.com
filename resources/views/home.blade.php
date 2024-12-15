@extends('layout')

@section('title')

@section('content')
  @foreach ($posts as $document)
      <div class="pb-20">
        <h2 class="text-3xl font-bold mb-2 text-zinc-600 dark:text-zinc-300 hover:text-red-800"><a href="{{ route('article', $document->slug) }}">{{ $document->title }}</a></h2>
        <p class="text-zinc-600 dark:text-zinc-300 text-xl/9">{{ $document->summary }}</p>
      </div>
  @endforeach

  <footer>
    {{ $posts->links('pagination') }}
  </footer>
@endsection
