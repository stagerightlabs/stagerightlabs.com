@section('title')
  Series: {{ $series->name }}
@endsection

<div>
  <x-heading>
    Series: {{ $series->name }}
    <x-slot name="options">
      <x-button.primary
        type="button"
        x-data=""
        x-on:click="if (confirm('Are you sure you want to remove the {{ $series->name }} series?')) { $wire.call('remove', '{{ $series->reference_id }}')}"
        icon="heroicon-s-trash"
        wrapper="mr-2"
      >Delete</x-button.primary>
      <x-button.primary
        url="{{ route('backstage.series.update', $series->reference_id) }}"
        icon="heroicon-s-pencil"
        wrapper="mr-2"
      >Edit</x-button.primary>

      <x-button.secondary
        url="{{ route('backstage.series.index') }}"
        icon="heroicon-s-rewind"
      >Index</x-button.secondary>
    </x-slot>
  </x-heading>
  <x-alert.tray :messages="$messages" class="mb-4" />
  <x-card class="mb-8">
    <x-description-list class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
      <x-description class="sm:col-span-1" label="Description">
        {{ $series->description }}
      </x-description>
      <x-description class="sm:col-span-1" label="Slug">
        {{ $series->slug }}
      </x-description>
    </x-description-list>
  </x-card>

  <x-card class="mb-8" heading="Posts">
    <div
      wire:sortable="updatePostOrder"
      wire:sortable.classes.over="bg-opacity-50"
      wire:sortable.mirror.constrain
    >
      @forelse ($series->posts as $post)
        <p
          class="bg-cool-gray-600 rounded mb-4 p-3 flex justify-between"
          wire:sortable.item="{{ $post->id }}"
          wire:key="post-{{ $post->id }}"
        >
          <span class="text-left flex">
            <span wire:sortable.handle class="cursor-move">
              @svg('heroicon-s-hand', ['class' => 'h-5 w-5 text-cool-gray-500 mr-4'])
            </span>
            {{ $post->pivot->sort_order }}. {{ $post->title }}
          </span>

          <span>
            <span class="mr-8">
              @if($post->published_at)
                Published {{ $post->published_at->format('Y-m-d') }}
              @else
                DRAFT
              @endif
            </span>
            <a
              href="{{ route('backstage.posts.show', $post->reference_id) }}"
              class="text-red-600 hover:text-red-800"
            >View</a>
          </span>
        </p>
      @empty
        <p>There are no posts in this series.</p>
      @endforelse
    </div>
  </x-card>
</div>
