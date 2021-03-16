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
    </x-description-list>
  </x-card>

  <x-card class="mb-8" heading="Posts">
    @if($series->posts->isEmpty())
      <p>There are no posts in this series.</p>
    @else
      <p>Posts</p>
    @endif
  </x-card>
</div>
