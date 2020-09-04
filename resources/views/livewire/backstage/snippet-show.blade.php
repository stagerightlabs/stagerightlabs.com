<div>
  <x-heading>
    Snippet {{ $snippet->reference_id }}
    <x-slot name="options">
      <x-button.secondary
        url="{{ route('backstage.snippets.index') }}"
        icon="heroicon-s-rewind"
      >Go Back</x-button.secondary>
      <x-button.primary
        wrapper="ml-2"
        url="{{ route('backstage.snippets.update', $snippet->reference_id) }}"
        icon="heroicon-s-pencil"
      >Edit</x-button.primary>
    </x-slot>
  </x-heading>

  <x-card class="px-4 py-5 sm:px-6">
    <x-description-list class="grid grid-cols-1 col-gap-4 row-gap-8 sm:grid-cols-2">
      <x-description class="sm:col-span-1" label="Name">{{ $snippet->name }}</x-description>
      <x-description class="sm:col-span-1" label="Shortcode">
        <code>{{ $snippet->shortcode }}</code>
      </x-description>
      <x-description class="sm:col-span-1" label="Language">{{ $snippet->language ?? 'None'}}</x-description>
      <x-description class="sm:col-span-1" label="Starting Line Number">{{ $snippet->starting_line }}</x-description>
      <x-description class="sm:col-span-1" label="Filename">
        {{ $snippet->filename ?? 'None' }}
      </x-description>
      <x-description class="sm:col-span-1" label="URL">
        {{ $snippet->url ?? 'None' }}
      </x-description>
      <x-description class="sm:col-span-2" label="Rendered Content">
        {!! $snippet->rendered !!}
      </x-description>
    </x-description-list>
  </x-card>
</div>
