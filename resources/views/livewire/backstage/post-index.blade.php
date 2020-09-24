@section('title', 'Posts')

<div>
  <x-heading>
    Posts
    <x-slot name="options">
      <x-button.primary
        url="{{ route('backstage.posts.create') }}"
        icon="heroicon-s-document-add"
      >Create Post</x-button.primary>
    </x-slot>
  </x-heading>
  <x-alert.tray :messages="$messages" class="mb-4" />
  @if ($posts->isNotEmpty())
  <x-table>
      <x-slot name="th">
        <x-table.th>Title</x-table.th>
        <x-table.th>Published?</x-table.th>
        <x-table.th>Created</x-table.th>
        <x-table.th></x-table.th>
      </x-slot>
      @foreach ($posts as $post)
        <x-table.tr>
          <x-table.td>{{ $post->title }}</x-table.td>
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
        {{ $posts->links() }}
      </x-slot>
    </x-table>
  @else
    <x-card>
      <p>There are no posts to display.</p>
    </x-card>
  @endif
</div>
