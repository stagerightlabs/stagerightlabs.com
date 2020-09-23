<div>
  <x-heading>
    {{ $post->title }}
    <x-slot name="options">
      <x-button.secondary
        url="{{ route('backstage.posts.show',$post->reference_id) }}"
        icon="heroicon-s-rewind"
      >Back</x-button.secondary>
    </x-slot>
  </x-heading>
  <x-card>
    @if (! $post->rendered)
      <p>This post has not yet been rendered.</p>
    @else
      {!! $post->rendered !!}
    @endif
  </x-card>
</div>
