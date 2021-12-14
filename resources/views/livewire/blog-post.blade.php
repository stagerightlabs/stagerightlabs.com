@section('title')
{{ $post->title }}
@endsection

@section('meta')
<x-meta.post :post="$post" />
@endsection

<div>
  <div class="mb-6 w-full">
    <h2 class="text-3xl leading-9 tracking-wide font-bold text-cool-gray-300 sm:text-4xl sm:leading-10">
      {{ $post->title }}
    </h2>
  </div>
  <div class="grid grid-cols-1 xl:grid-cols-2 gap-2 xl:gap-4 mb-2">
    <div class="col-span-1 text-base text-cool-gray-400 flex items-center">
      @if($post->hasBeenPublished())
          <p>
            Published
            <time datetime="{{ $post->published_at->toDateString() }}">
              {{ $post->published_at->format('F j, Y') }}
            </time>
            @if ($post->hasBeenUpdatedAfterPublicationDate())
            &bull; Updated
            <time datetime="{{ $post->updated_at->toDateString() }}">
              {{ $post->updated_at->format('F j, Y') }}
            </time>
            @endif
          </p>
        @else
          <span class="block ml-1">DRAFT</span>
        @endif
    </div>
    <div class="col-span-1 text-left xl:text-right">
      @foreach ($post->tags as $tag)
        @if (isset($topic) && $topic->slug == $tag->slug)
        <a href="{{ route('home') }}" class="">
          <x-tag :active="$tag->slug == $topic->slug">{{ $tag->name }}</x-tag>
        </a>
        @else
        <a href="{{ route('blog.topic', $tag->slug) }}" class="">
          <x-tag :active="isset($topic) && $tag->slug == $topic->slug">{{ $tag->name }}</x-tag>
        </a>
        @endif
      @endforeach
    </div>
  </div>
  @if($post->wasPublishedMoreThanAYearAgo())
    <aside class="text-center text-cool-gray-400 p-4 mt-4 mb-4 bg-cool-gray-900 rounded-md">
      Heads up! This article is more than {{ $post->publicationAgeForHumans() }} the content may be out of date.
    </aside>
  @endif
  <x-card class="mb-8">
    <x-post :post="$post" />
  </x-card>
  @if($post->stack_outline)
  <x-card class="mb-8 col-span-1 xl:col-span-10" heading="Tools Referenced In This Post">
    <div class="my-2 mx-2 stack-outline">
      <x-markdown>{{ $post->stack_outline }}</x-markdown>
    </div>
  </x-card>
  @endif
  @foreach ($post->series as $series)
    <x-part-of-a-series
      class="col-span-1 md:col-span-10"
      :series="$series"
      :post="$post"
    />
  @endforeach
  <x-author class="col-span-1 md:col-span-10" />
</div>
