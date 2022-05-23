@section('title', 'Blog')

@section('meta')
<x-meta.general />
@endsection

<div>
  <x-page-header>
    @if (isset($topic))
      Topic: {{ $topic->name }}
    @else
      Articles
    @endif
  </x-page-header>
  <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
    <div class="col-span-1 md:col-span-10">
      @foreach ($posts as $post)
        <a href="{{ route('blog.post', $post->slug) }}">
          <x-card class="mb-6">
            <h2 class="text-2xl mb-4">{{ $post->title }}</h2>
            <p class="text-cool-gray-400 text-xl mb-6">
              {{ $post->description }}
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2">
              <p class="grid-cols-1">
                @foreach($post->tags as $tag)
                  <x-tag :hover="false">{{ $tag->name }}</x-tag>
                @endforeach
              </p>
              <p class="grid-cols-1 inline-flex items-end justify-end text-red-700 text-lg">
                Read More
                @svg('heroicon-s-chevron-double-right', ['class' => 'h-4 w-4 mb-1 ml-1'])
              </p>
            </div>
          </x-card>
        </a>
      @endforeach

      <div class="w-full mt-8">
        {{ $posts->links('pagination-links-compact') }}
      </div>

    </div>
    <div class="col-span-1 md:col-span-2 lg:px-2 mt-4 md:mt-0">
      <p class="text-cool-gray-500 text-2xl tracking-wide mb-4">Topics</p>
      <ul>
        @foreach ($tags as $tag)
          <li class="inline-block md:block my-2">
            @if (isset($topic) && $topic->slug == $tag->slug)
            <a href="{{ route('home') }}" class="">
              <x-tag :active="$tag->slug == $topic->slug">{{ $tag->name }}</x-tag>
            </a>
            @else
            <a href="{{ route('blog.topic', $tag->slug) }}" class="">
              <x-tag :active="isset($topic) && $tag->slug == $topic->slug">{{ $tag->name }}</x-tag>
            </a>
            @endif
          </li>
        @endforeach
      </ul>
    </div>
  </div>

</div>
