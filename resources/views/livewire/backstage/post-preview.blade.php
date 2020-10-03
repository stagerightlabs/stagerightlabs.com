<div>
  <x-heading>
    Preview: {{ $post->title }}
    <x-slot name="options">
      <x-button.secondary
        url="{{ route('backstage.posts.show',$post->reference_id) }}"
        icon="heroicon-s-rewind"
      >Back to Post</x-button.secondary>
    </x-slot>
  </x-heading>
  @if (! $post->rendered)
  <x-card>
    <p>This post has not yet been rendered.</p>
  </x-card>
  @else
  <x-card>
    <x-post :post="$post" />
  </x-card>
  @endif
</div>
