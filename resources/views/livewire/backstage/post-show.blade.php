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
      <x-description class="sm:col-span-1" label="Summary">
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
      <x-description class="sm:col-span-1" label="URL">
        @if ($post->url)
        <a href="{{ $post->url }}" target="_blank">{{ $post->url }}</a>
        @endif
      </x-description>
      <x-description class="sm:col-span-1" label="Series">
        @forelse ($post->series as $series)
          <p class="flex">
            <a href="{{ route('backstage.series.show', $series->reference_id) }}">{{ $series->name }}</a>
            <button wire:click="removeSeries('{{ $series->id }}')">
              @svg('heroicon-o-trash', ['class' => 'ml-1 mr-1 h-5 w-5 shrink-0 text-cool-gray-500'])
            </button>
          </p>
        @empty
          None
        @endforelse
      </x-description>
      @if ($availableSeries->isNotEmpty())
      <x-description class="sm:col-span-1" label="Add Series">
        <form class="flex" wire:submit.prevent="addSeries">
          <x-form.select wrapper="w-full" wire:model.lazy="seriesIdToAdd">
            <option></option>
            @foreach ($availableSeries as $id => $name)
              <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
          </x-form.select>
          <x-button.secondary
            icon="heroicon-o-plus-circle"
            wrapper="ml-2 mt-1"
            type="submit"
          >Add</x-button.secondary>
        </form>
      </x-description>
      @endif
    </x-description-list>
  </x-card>
  <x-card heading="Content">
    <div class="p-4 whitespace-pre-wrap font-mono">{{ $post->content }}</div>
  </x-card>
  @if ($post->stack_outline)
  <x-card heading="Stack Outline" class="mt-8">
    <div class="p-4 whitespace-pre-wrap font-mono">{{ $post->stack_outline }}</div>
  </x-card>
  @endif
</div>
