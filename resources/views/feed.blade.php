<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
  <channel>
    <title>Stage Right Labs</title>
    <link>https://stagerightlabs.com</link>
    <description>Ideas and musings about software and web application development.</description>
    <language>en</language>
    <pubDate>{{ now() }}</pubDate>
    @foreach($posts as $post)
    <item>
      <title>
        <![CDATA[{{ $post->title }}]]>
      </title>
      <link>{{ $post->url }}</link>
      <description>
        <![CDATA[{!! $post->description !!}]]>
      </description>
      <author>Ryan C. Durham</author>
      <guid>{{ $post->id }}</guid>
      <pubDate>{{ $post->published_at->toRssString() }}</pubDate>
    </item>
    @endforeach
  </channel>
</rss>
