@section('title')
{{ $post->title }}
@endsection

@section('meta')
<x-meta.post :post="$post" />
@endsection

<div>
  <x-card class="mb-8">
    <article class="post">
      <header class="pb-4">
        <h1 class="text-3xl mb-2">{{ $post->title }}</h1>
        <div class="md:flex md:justify-between md:items-center">
          <time datetime="{{ $post->published_at->toAtomString() }}" class="block mb-1 text-cool-gray-400">
            {{ $post->published_at->format('F j, Y') }}
          </time>
          <div>
            @foreach ($post->tags as $tag)
              <x-tag>{{ $tag->name }}</x-tag>
            @endforeach
          </div>
        </div>
      </header>
      @if ($post->wasPublishedMoreThanAYearAgo())
        <aside class="border border-red-800 text-center text-cool-gray-400 p-4 mt-4 mb-8">
          This post is more than a year old; it is possible the content is now a bit out of date.
        </aside>
      @endif
      <div class="content">
        {!! $post->rendered !!}
      </div>
    </article>
  </x-card>
  <x-author />
</div>
