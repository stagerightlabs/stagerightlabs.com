@props([
  'series' => null,
  'post' => null,
])

@if ($series && $series->publishedPosts->count() > 1)
<x-card {{ $attributes->merge(['class' => 'mb-8'])}} :heading="$series->name">
  <p class="text-lg mb-4">{{ $series->name }}</p>
  <ol class="list-decimal list-inside">
  @foreach ($series->publishedPosts as $link)
    <li class="my-1 text-lg">
      @if ($post->id == $link->id)
        <strong>{{ $link->title }}</strong>
      @else
      <a href="{{ route('blog.post', $link->slug) }}" class="red-underline">{{ $link->title }}</a>
      @endif
    </li>
  @endforeach
  </ol>
</x-card>
@endif
