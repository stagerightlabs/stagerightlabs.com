@extends('layout')

@section('title', $document->title)

@section('content')
  {!! $document->content !!}

  @if($document->series)
    <div>
      <ul>
        @foreach ($series[$document->series] as $post)
          @if (route('blog.show', $document->slug()) == $post['link'])
          <li>{{ $post['title']}}</li>
          @else
            <li><a href="{{ $post['link'] }}">{{ $post['title']}}</a></li>
          @endif
        @endforeach
      </ul>
    </div>
  @endisset
@endsection
