@section('title')
  Post: {{ $post->title }}
@endsection

<div>
  <x-heading>
    Post: {{ $post->title }}
    <x-slot name="options">
      <x-button.primary
        url="{{ route('backstage.posts.update', $post->reference_id) }}"
        icon="heroicon-s-pencil"
        wrapper="mr-2"
      >Edit</x-button.primary>
      <x-button.secondary
        url="{{ route('backstage.posts.preview', $post->reference_id) }}"
        icon="heroicon-s-eye"
        wrapper="mr-2"
      >Preview</x-button.secondary>
      <x-button.secondary
        url="{{ route('backstage.posts.index') }}"
        icon="heroicon-s-rewind"
      >Index</x-button.secondary>
    </x-slot>
  </x-heading>
  <x-alert.tray :messages="$messages" class="mb-4" />
  <x-card class="mb-8">
    <x-description-list class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
      <x-description class="sm:col-span-1" label="Description">
        {{ $post->description }}
      </x-description>
      <x-description class="sm:col-span-1" label="Tags">
        @forelse ($post->tags as $tag)
          <x-tag>{{ $tag->name }}</x-tag>
        @empty
        No Tags
        @endforelse
      </x-description>
      <x-description class="sm:col-span-1" label="Status">
        @if ($post->published_at)
          Published {{ $post->published_at->format('Y-m-d') }}
        @else
          DRAFT
        @endif
      </x-description>
      <x-description class="sm:col-span-1" label="URL">{{ $post->url }}</x-description>

    </x-description-list>
  </x-card>
  <x-card heading="Content">
    <div class="p-4 whitespace-pre-wrap font-mono">{{ $post->content }}</div>
  </x-card>
</div>
