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
    @if ($post->stack_outline)
    <x-card class="mb-8 col-span-1 xl:col-span-10" heading="Tools Referenced In This Post">
      <div class="my-2 mx-2 stack-outline">
        <x-markdown>{{ $post->stack_outline }}</x-markdown>
      </div>
    </x-card>
    @endif
    <aside class="col-span-1 xl:col-span-2 row-start-1 xl:row-start-auto lg:px-2 text-cool-gray-600 grid grid-flow-col-dense grid-cols-2 xl:grid-cols-none gap-4 xl:block">
      <div class="flex justify-end xl:block grid-cols-1 col-start-2">
        <ul class="mt-1 xl:mt-0">
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
      <p class="flex items-center grid-cols-1 col-start-1 text-sm xl:mt-2 text-cool-gray-500">
        @if($post->hasBeenPublished())
          <time
            datetime="{{ $post->published_at->toDateString() }}"
            class="block ml-1"
          >
            {{ $post->published_at->format('F j, Y') }}
          </time>
        @else
          <span class="block ml-1">DRAFT</span>
        @endif
      </p>
    </aside>
  </div>
  @endif
</div>
