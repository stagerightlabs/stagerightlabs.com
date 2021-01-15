@section('title', 'Update Snippet')

<div>
  <x-heading>
    Update Snippet {{ $snippet->reference_id }}
    <x-slot name="options">
      <x-button.secondary
        url="{{ route('backstage.snippets.show', $snippet->reference_id) }}"
        icon="heroicon-s-rewind"
      >Cancel</x-button.secondary>
    </x-slot>
  </x-heading>
  <x-card>
    <form wire:submit.prevent="update">

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <x-form.text
          class="col-span-1"
          :error="$errors->first('name')"
          label="Name"
          type="text"
          wire:model.lazy="name"
        />
        <x-form.text
          class="col-span-1"
          :error="$errors->first('language')"
          label="Language"
          type="text"
          wire:model.lazy="language"
        />
        <x-form.text
          class="col-span-1"
          :error="$errors->first('filename')"
          label="Filename"
          type="text"
          wire:model.lazy="filename"
        />
        <x-form.text
          class="col-span-1"
          :error="$errors->first('url')"
          label="URL"
          type="text"
          wire:model.lazy="url"
        />
        <x-form.text
          class="col-span-1"
          :error="$errors->first('startingLineNumber')"
          label="Starting Line Number"
          type="number"
          wire:model.lazy="startingLineNumber"
        />
        <div class="col-span-1">
          <div class="sm:mt-6">
            <input
              id="public"
              type="checkbox"
              class="rounded h-4 w-4 text-red-800 transition duration-150 ease-in-out bg-cool-gray-600 border-cool-gray-500 focus:ring-cool-gray-400 focus:border-cool-gray-400"
              wire:model="isPublic"
              name="public"
              value="true"
            >
            <label for="public">Allow public access?</label>
          </div>
        </div>
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
