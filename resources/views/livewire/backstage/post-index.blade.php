@section('title', 'Posts')

<div>
  <x-heading>
    Posts
    <x-slot name="options">
      <x-button.primary
        url="{{ route('backstage.posts.create') }}"
        icon="heroicon-s-document-add"
        class="mr-2"
      >Create Post</x-button.primary>
      <x-button.secondary
        type="button"
        wire:click="dispatchBatchRenderingJobs"
      >Batch Render</x-button.secondary>
    </x-slot>
  </x-heading>
  <x-alert.tray :messages="$messages" class="mb-4" />
  @if ($posts->isNotEmpty())
  <x-table>
      <x-slot name="th">
        <x-table.th>Title</x-table.th>
        <x-table.th>Series</x-table.th>
        <x-table.th>Published?</x-table.th>
        <x-table.th>Created</x-table.th>
        <x-table.th></x-table.th>
      </x-slot>
      @foreach ($posts as $post)
        <x-table.tr>
          <x-table.td>{{ $post->title }}</x-table.td>
          <x-table.td>
            @foreach ($post->series as $series)
              <a
                href="{{ route('backstage.series.show', $series->reference_id) }}"
                title="{{ $series->name }}"
              >{{ $series->reference_id }}</a>
            @endforeach
          </x-table.td>
          <x-table.td>{{ $post->published_at ? $post->published_at->format('Y-m-d') : 'DRAFT' }}</x-table.td>
          <x-table.td>{{ $post->created_at->format('Y-m-d') }}</x-table.td>
          <x-table.td class="text-right">
            <a
              href="{{ route('backstage.posts.show', $post->reference_id) }}"
              class="text-red-600 hover:text-red-700"
            >Manage</a>
          </x-table.td>
        </x-table.tr>
      @endforeach
      <x-slot name="footer">
        {{ $posts->links('pagination-links') }}
      </x-slot>
    </x-table>
  @else
    <x-card>
      <p>There are no posts to display.</p>
    </x-card>
  @endif
</div>
