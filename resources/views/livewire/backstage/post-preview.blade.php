<div>
  <x-heading>
    <p class="text-cool-gray-500">
      Preview:
    </p>
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
        <p class="flex items-center text-cool-gray-500">
          @svg('heroicon-s-pencil', ['class' => 'h-5 w-5 mr-1']) DRAFT
        </p>
      @endif
      <div class="flex justify-end xl:block xl:mt-4 grid-cols-1">
        <p class="hidden xl:flex items-center mb-2 text-cool-gray-500">
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
  @endif
</div>
