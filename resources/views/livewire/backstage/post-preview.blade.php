<div>
  <x-heading>
    <p class="text-cool-gray-500">
      Preview:
    </p>
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
  <div class="mb-4 w-full">
    <h2 class="text-3xl leading-9 tracking-wide font-bold text-cool-gray-300 sm:text-4xl sm:leading-10">
      {{ $post->title }}
    </h2>
  </div>
  <x-card>
    <x-post :post="$post" />
  </x-card>
  @endif
</div>
