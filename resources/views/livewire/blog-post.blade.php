@section('title')
{{ $post->title }}
@endsection

@section('meta')
<x-meta.post :post="$post" />
@endsection

<div>
  <div class="mb-4 w-full">
    <h2 class="text-3xl leading-9 tracking-wide font-bold text-cool-gray-300 sm:text-4xl sm:leading-10">
      {{ $post->title }}
    </h2>
  </div>
  <div class="grid grid-cols-1 xl:grid-cols-12 gap-2 xl:gap-4 ">
    <x-card class="mb-8 col-span-1 xl:col-span-10">
      <x-post :post="$post" />
    </x-card>
    <aside class="col-span-1 xl:col-span-2 row-start-1 xl:row-start-auto lg:px-2 text-cool-gray-600 grid grid-cols-2 xl:grid-cols-none gap-4 xl:block">
      @if($post->hasBeenPublished())
        <p class="flex items-center grid-cols-1">
          @svg('heroicon-s-clock', ['class' => 'h-5 w-5'])
          <time
            datetime="{{ $post->published_at->toAtomString() }}"
            class="block ml-1 text-cool-gray-500"
          >
            {{ $post->published_at->format('F j, Y') }}
          </time>
        </p>
      @else
        <p>
          @svg('heroicon-s-pencil', ['class' => 'h-5 w-5']) DRAFT
        </p>
      @endif
      <div class="flex justify-end xl:block xl:mt-4 grid-cols-1">
        <p class="hidden xl:flex items-center mb-2">
          @svg('heroicon-s-tag', ['class' => 'h-5 w-5'])
          Topics
        </p>
        <ul class="">
          @foreach ($post->tags as $tag)
          <li class="inline-block xl:block my-1">
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
    </aside>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
    <x-author class="col-span-1 md:col-span-10" />
  </div>
</div>
