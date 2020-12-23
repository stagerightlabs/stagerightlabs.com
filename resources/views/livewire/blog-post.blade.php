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
  <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
    <x-author class="col-span-1 md:col-span-10" />
  </div>
</div>
