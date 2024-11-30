@extends('layout')

@section('title', 'Blog')

@section('content')
  @foreach ($posts as $document)
      <div>
        <h2>{{ $document->title }}</h2>
        <p>{{ $document->summary }}</p>
        <p>{{ $document->date }}</p>
        <p><a href="{{ route('blog.show', $document->slug) }}">Link</a></p>
      </div>
  @endforeach

  <footer>
    {{ $posts->links() }}
  </footer>
@endsection
