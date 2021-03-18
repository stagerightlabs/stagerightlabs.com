@section('title')
{{ $series->title }}
@endsection

@section('meta')
<x-meta.general />
@endsection

<div>
  <x-page-header>{{ $series->name }}</x-page-header>
  <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
    <div class="col-span-1 md:col-span-12">
      <p class="text-xl mb-8 m-1">{{ $series->description }}</p>
      @foreach ($series->publishedPosts as $post)
        <a href="{{ route('blog.post', $post->slug) }}">
          <x-card class="mb-4">
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
    </div>
  </div>
</div>
