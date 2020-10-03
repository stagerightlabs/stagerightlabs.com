@section('title', 'Create Post')

<div>
  <x-heading>
    Create Post
    <x-slot name="options">
      <x-button.secondary
        url="{{ route('backstage.posts.index') }}"
        icon="heroicon-s-rewind"
      >Nevermind</x-button.secondary>
    </x-slot>
  </x-heading>
  <x-alert.tray :messages="$messages" class="mb-4" />
  <x-card>
    <form wire:submit.prevent="store">
      <x-form.text
        class="col-span-1"
        :error="$errors->first('title')"
        label="Title"
        type="text"
        wire:model.lazy="title"
      />

      <x-form.text
        class="col-span-1"
        :error="$errors->first('description')"
        label="Description"
        type="text"
        wire:model.lazy="description"
        wrapper="mt-4"
      />

      <label class="block text-sm font-medium leading-5 text-cool-gray-300 mt-4">
        Tags
      </label>
      <div class="w-full grid grid-cols-1 sm:grid-cols-4 gap-4 p-4">
        @forelse($availableTags as $slug => $label)
          <div class="col-span-1">
            <input
              id="permissions.{{ $slug }}"
              type="checkbox"
              class="form-checkbox h-4 w-4 text-red-800 transition duration-150 ease-in-out bg-cool-gray-600 border-cool-gray-500"
              wire:model="tags"
              name="tags[]"
              value="{{ $slug }}"
            >
            <label for="permissions.{{ $slug }}">{{ $label }}</label>
          </div>
        @empty
          <p class="text-cool-gray-500">There are no tags.</p>
        @endforelse
      </div>

      <x-form.textarea
        class="resize-y font-mono"
        label="Content"
        :error="$errors->first('content')"
        rows="20"
        wire:model.lazy="content"
        wrapper="mt-4"
      />

      <div class="flex justify-center mt-4">
        <x-button.primary type="submit">Save</x-button.primary>
      </div>
    </form>
  </x-card>
</div>
