@extends("layout")

@section("title")

@section("content")
  @foreach ($posts as $document)
    <div class="pb-20">
      <h2
        class="mb-2 text-3xl font-bold text-zinc-600 hover:text-red-800 dark:text-zinc-300"
      >
        <a href="{{ route("article", $document->slug) }}">
          {{ $document->title }}
        </a>
      </h2>
      <p class="text-xl/9 text-zinc-600 dark:text-zinc-300">
        {{ $document->summary }}
      </p>
    </div>
  @endforeach

  <footer>
    {{ $posts->links("pagination") }}
  </footer>
@endsection
