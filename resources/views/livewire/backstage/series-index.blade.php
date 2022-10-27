@section('title', 'Series')

<div>
  <x-heading>
    Series
    <x-slot name="options">
      <x-button.primary
        url="{{ route('backstage.series.create') }}"
        icon="heroicon-s-document-plus"
        class="mr-2"
      >Create Series</x-button.primary>
    </x-slot>
  </x-heading>
  <x-alert.tray :messages="$messages" class="mb-4" />
  @if ($series->isNotEmpty())
    <x-table>
      <x-slot name="th">
        <x-table.th>Name</x-table.th>
        <x-table.th></x-table.th>
      </x-slot>
      @foreach ($series as $s)
        <x-table.tr>
          <x-table.td>{{ $s->name }}</x-table.td>
          <x-table.td class="text-right">
            <a
              href="{{ route('backstage.series.show', $s->reference_id) }}"
              class="text-red-600 hover:text-red-700"
            >Manage</a>
          </x-table.td>
        </x-table.tr>
      @endforeach
      <x-slot name="footer">
        {{ $series->links('pagination-links') }}
      </x-slot>
    </x-table>
  @else
    <x-card>
      <p>There are no series to display.</p>
    </x-card>
  @endif
</div>
