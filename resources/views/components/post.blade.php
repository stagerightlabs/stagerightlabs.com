<article class="post">
  <header class="pb-4">
    <div class="md:flex md:justify-between md:items-center">
      @if ($post->hasBeenPublished())
      <time
        datetime="{{ $post->published_at->toAtomString() }}"
        class="block mb-1 text-cool-gray-400">
        {{ $post->published_at->format('F j, Y') }}
      </time>
      @else
        <div class="mb-1 text-cool-gray-400">DRAFT</div>
      @endif
      <div>
        @foreach($post->tags as $tag)
          <x-tag>{{ $tag->name }}</x-tag>
        @endforeach
      </div>
    </div>
  </header>
  @if($wasPublishedMoreThanAYearAgo())
    <aside class="text-center text-cool-gray-400 p-4 mt-4 mb-4 bg-cool-gray-900 rounded-md">
      Heads up! This article is more than {{ $publicationAgeForHumans }} the content may be out of date.
    </aside>
  @endif
  <div class="content">
    {!! $post->rendered !!}
  </div>
</article>
