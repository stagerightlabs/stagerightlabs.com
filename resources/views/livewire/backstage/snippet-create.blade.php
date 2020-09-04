<div>
  <x-heading>
    Create New Snippet
    <x-slot name="options">
      <x-button.secondary
        url="{{ route('backstage.snippets.index') }}"
      >Nevermind...</x-button.primary>
    </x-slot>
  </x-heading>
  <x-card>
    <form wire:submit.prevent="store">

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
      </div>

      <x-form.textarea
        class="resize-y"
        label="Content"
        :error="$errors->first('content')"
        rows="10"
        wire:model.lazy="content"
        wrapper="mt-4"
      />

      <div class="flex justify-center mt-4">
        <x-button.primary type="submit">Save</x-button.primary>
      </div>
    </form>
  </x-card>
</div>
