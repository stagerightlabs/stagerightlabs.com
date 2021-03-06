@php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
@endphp

<urlset
  xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"
  xmlns:xhtml="http://www.w3.org/1999/xhtml"
  xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0"
  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
  xmlns:video="http://www.google.com/schemas/sitemap-video/1.1"
>
@foreach($posts as $post)
  <url>
    <loc>{{ $post->url }}</loc>
    <lastmod>{{ $post->updated_at->format('Y-m-d') }}</lastmod>
    <changefreq>monthly</changefreq>
  </url>
@endforeach
@php
  $decks = [
    'laravel-101',
    'single-table-inheritance',
    'the-secret-power-of-renderless-vue-components',
    'tailwind-css',
    'intro-to-docker'
  ];
@endphp
@foreach($decks as $slug)
  <url>
    <loc>{{ route('decks.show', [$slug]) }}</loc>
    <changefreq>monthly</changefreq>
  </url>
@endforeach
<url>
  <loc>{{ route('decks.index') }}</loc>
</url>
<url>
  <loc>{{ route('projects.index') }}</loc>
</url>
</urlset>
