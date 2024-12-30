@extends("layout")

@section("title")
  @yield("code")
@endsection

@section("content")
  <div
    class="flex h-96 flex-col items-center justify-center xl:absolute xl:inset-0 xl:h-screen xl:w-2/3"
  >
    <h1 class="mb-4 text-8xl">@yield("code")</h1>
    <p class="text-4xl">@yield("message")</p>
  </div>
@endsection
