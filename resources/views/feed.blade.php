<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title>Stage Right Labs</title>
  <subtitle>Ideas and musings about software and web application development.</subtitle>
  <link href="https://stagerightlabs.com/feed" rel="self" />
  <link href="https://stagerightlabs.com" />
  <updated>{{ now()->toAtomString() }}</updated>

  <author>
    <name>Ryan C. Durham</name>
    <uri>https://stagerightlabs.com</uri>
  </author>

  <id>https://stagerightlabs.com/</id>
  <icon>{{ url(asset('img/compact.png')) }}</icon>
  <logo>{{ url(asset('img/compact.png')) }}</logo>
  <rights>©{{ date('Y') }} Ryan C. Durham</rights>

  <image>
    <link>https://stagerightlabs.com/</link>
    <title><![CDATA[Stage Right Labs]]></title>
    <url>{{ url(asset('img/compact.png')) }}</url>
  </image>

  @foreach($posts as $post)
  <entry>
    <title>
      <![CDATA[{{ $post->title }}]]>
    </title>
    <id>tag:stagerightlabs.com,{{ $post->published_at->toDateString() }}:{{ $post->published_at->format('U') }}</id>
    <updated>{{ $post->published_at->toAtomString() }}</updated>
    <summary>
      <![CDATA[{!! $post->description !!}]]>
    </summary>
    <content type="html">
      <![CDATA[{!! $post->rendered !!}]]>
    </content>
    <link rel="alternate" href="{{ $post->url }}" />
  </entry>
  @endforeach
</feed>
