<div>
  <x-heading>
    Preview: {{ $post->title }}
    <x-slot name="options">
      <x-button.secondary
        url="{{ route('backstage.posts.show',$post->reference_id) }}"
        icon="heroicon-s-rewind"
      >Back to Post</x-button.secondary>
    </x-slot>
  </x-heading>
  @if (! $post->rendered)
  <x-card>
    <p>This post has not yet been rendered.</p>
  </x-card>
  @else
  <x-card>
    <article class="post">
      <header class="pb-4">
        <h1 class="text-3xl mb-2">{{ $post->title }}</h1>
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
      @if($post->wasPublishedMoreThanAYearAgo())
        <aside class="border border-red-800 text-center text-cool-gray-400 p-4 mt-4 mb-8">
          This post is more than a year old; it is possible the content is now a bit out of date.
        </aside>
      @endif
      <div class="content">
        {!! $post->rendered !!}
      </div>
    </article>
  </x-card>
  @endif
</div>
