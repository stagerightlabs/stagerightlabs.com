<div>
  <x-heading>
    Snippet {{ $snippet->reference_id }}
    <x-slot name="options">
      <x-button.primary
        wrapper="mr-2"
        url="{{ route('backstage.snippets.update', $snippet->reference_id) }}"
        icon="heroicon-s-pencil"
      >Edit</x-button.primary>
      <x-button.secondary
        url="{{ route('backstage.snippets.index') }}"
        icon="heroicon-s-rewind"
      >Index</x-button.secondary>
    </x-slot>
  </x-heading>

  <x-card class="mb-8" heading="Name: {{ $snippet->name }}">
    <x-description-list class="grid grid-cols-1 col-gap-4 row-gap-8 sm:grid-cols-2 px-4 py-2">
      <x-description class="sm:col-span-1" label="Shortcode">
        <code>{{ $snippet->shortcode }}</code>
      </x-description>
      <x-description class="sm:col-span-1" label="Language">{{ $snippet->language ?? 'None'}}</x-description>
      <x-description class="sm:col-span-1" label="Starting Line Number">{{ $snippet->starting_line }}</x-description>
      <x-description class="sm:col-span-1" label="Filename">
        {{ $snippet->filename ?? 'None' }}
      </x-description>
      <x-description class="sm:col-span-1" label="Link">
        {{ $snippet->url ?? 'None' }}
      </x-description>
      <x-description class="sm:col-span-1" label="Post(s)">
        @foreach ($snippet->getPostsThatUseThisSnippet() as $post)
          <a href="{{ route('backstage.posts.show', $post->reference_id) }}">
            {{ $post->title }}
          </a>
        @endforeach
      </x-description>
    </x-description-list>
  </x-card>
  <x-card heading="Rendered Content">
    {!! $snippet->rendered !!}
  </x-card>
</div>
