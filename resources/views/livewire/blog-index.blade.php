@section('title', 'Blog')

@section('meta')
<x-meta.general />
@endsection

<div>
  <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
    <div class="col-span-1 md:col-span-9">
      <x-card :heading="isset($topic) ? 'Topic: ' . $topic->name : null">
        @foreach ($posts as $post)
          <div class="mb-6">
            <a href="{{ route('blog.post', $post->slug) }}">
              <h2 class="text-2xl">{{ $post->title }}</h2>
            </a>
            <p class="text-cool-gray-500">
              {{ $post->description }}
              <a href="{{ route('blog.post', $post->slug) }}" class="text-red-700 inline-flex items-end">
                Read More
                @svg('heroicon-s-chevron-double-right', ['class' => 'h-4 w-4 mb-1'])
              </a>
            </p>
          </div>
        @endforeach
        <div class="w-full text-center mt-8">
          {{ $posts->links() }}
        </div>
      </x-card>
    </div>
    <div class="col-span-1 md:col-span-3">
      <x-card heading="Topics">
      @foreach ($tags as $tag)
        <div class="mb-2">
          @if (isset($topic) && $topic->slug == $tag->slug)
          <a href="{{ route('home') }}">
            <x-tag :active="$tag->slug == $topic->slug">{{ $tag->name }}</x-tag>
          </a>
          @else
          <div class="mb-2">
            <a href="{{ route('blog.topic', $tag->slug) }}">
              <x-tag :active="isset($topic) && $tag->slug == $topic->slug">{{ $tag->name }}</x-tag>
            </a>
          </div>
          @endif
        </div>
      @endforeach
      </x-card>
    </div>
  </div>

</div>
