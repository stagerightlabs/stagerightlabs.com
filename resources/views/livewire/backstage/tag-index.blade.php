@section('title', 'Tags')

<div>
  <x-heading>
    Tags
    <x-slot name="options">
      <x-button.primary
        url="{{ route('backstage.tags.create') }}"
        icon="heroicon-s-document-add"
      >Create Tag</x-button.primary>
    </x-slot>
  </x-heading>
  <x-alert.tray :messages="$messages" class="mb-4" />
  <x-card>
    @if ($tags->isNotEmpty())
      <ul class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach($tags as $tag)
        <li class="col-span-1 flex shadow-sm rounded-md">
          <div class="flex-1 flex items-center justify-between border border-cool-gray-800 bg-cool-gray-600 rounded-md truncate">
            <div class="flex-1 px-4 py-2 text-sm leading-5 truncate">
              {{ $tag->name }}
              <p class="text-cool-gray-400 text-sm">/{{ $tag->slug }}</p>
            </div>
            <div class="flex-shrink-0 pr-2">
              <a
                class="w-8 h-8 inline-flex items-center justify-center text-gray-400 rounded-full bg-transparent hover:text-cool-gray-500 focus:outline-none focus:text-gray-500 focus:bg-gray-100 transition ease-in-out duration-150"
                href="{{ route('backstage.tags.update', $tag->reference_id) }}"
                title="Edit Tag"
              >
                @svg('heroicon-o-pencil', ['class' => 'h-5 w-5'])
              </a>
              <button
                class="w-8 h-8 inline-flex items-center justify-center text-gray-400 rounded-full bg-transparent hover:text-cool-gray-500 focus:outline-none focus:text-gray-500 focus:bg-gray-100 transition ease-in-out duration-150"
                x-data
                x-on:click="if (confirm('Are you sure you want to remove the {{ $tag->name }} tag?')) { @this.call('remove', '{{ $tag->reference_id }}')}"
                title="Delete Tag"
              >
                @svg('heroicon-o-trash', ['class' => 'h-5 w-5'])
              </button>
            </div>
          </div>
        </li>
        @endforeach
      </ul>
    @else
      <p>There are no tags to display.</p>
    @endif
  </x-card>
</div>
