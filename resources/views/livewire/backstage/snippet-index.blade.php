@section('title', 'Snippets')

<div>
  <x-heading>
    Snippets
    <x-slot name="options">
      <x-button.primary
        url="{{ route('backstage.snippets.create') }}"
        icon="heroicon-s-document-plus"
        wrapper="mr-2"
      >Create Snippet</x-button.primary>
      <x-button.secondary
        type="button"
        wire:click="dispatchBatchRenderingJobs"
      >Batch Render</x-button.secondary>
    </x-slot>
  </x-heading>
  <x-alert.tray :messages="$messages" class="mb-4" />
  @if ($snippets->isNotEmpty())
  <x-table>
      <x-slot name="th">
        <x-table.th>Name</x-table.th>
        <x-table.th>Language</x-table.th>
        <x-table.th>Short Code</x-table.th>
        <x-table.th></x-table.th>
      </x-slot>
      @foreach ($snippets as $snippet)
        <x-table.tr>
          <x-table.td>{{ $snippet->name }}</x-table.td>
          <x-table.td>{{ $snippet->language }}</x-table.td>
          <x-table.td><code>{{ $snippet->shortcode }}</code></x-table.td>
          <x-table.td class="text-right">
            <a
              href="{{ route('backstage.snippets.show', $snippet->reference_id) }}"
              class="text-red-600 hover:text-red-700"
            >View</a>
          </x-table.td>
        </x-table.tr>
      @endforeach
      <x-slot name="footer">
        <div class="bg-cool-gray-900">
          {{ $snippets->links('pagination-links') }}
        </div>
      </x-slot>
    </x-table>
  @else
    <x-card>
      <p>There are no snippets to display.</p>
    </x-card>
  @endif
</div>
