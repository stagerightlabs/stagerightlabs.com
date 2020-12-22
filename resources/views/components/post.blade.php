<article class="post my-4 mx-2">
  @if($wasPublishedMoreThanAYearAgo())
    <aside class="text-center text-cool-gray-400 p-4 mt-4 mb-4 bg-cool-gray-900 rounded-md">
      Heads up! This article is more than {{ $publicationAgeForHumans }} the content may be out of date.
    </aside>
  @endif
  <div class="content">
    {!! $post->rendered !!}
  </div>
</article>
