@section('title', 'Edit Tag')

<div>
  <x-heading>
    Edit Tag {{ $tag->reference_id }}
    <x-slot name="options">
      <x-button.secondary
        url="{{ route('backstage.tags.index') }}"
        icon="heroicon-s-rewind"
      >Nevermind</x-button.primary>
    </x-slot>
  </x-heading>
  <x-alert.tray :messages="$messages" class="mb-4" />
  <x-card>
    <form wire:submit.prevent="update">

      <div class="grid grid-cols-1 gap-4">
        <x-form.text
          class="col-span-1"
          :error="$errors->first('name')"
          label="Name"
          type="text"
          wire:model.lazy="name"
        />

        <x-form.text
          class="col-span-1"
          :error="$errors->first('slug')"
          label="Slug"
          type="text"
          wire:model.lazy="slug"
        />
      </div>

      <div class="flex justify-center mt-4">
        <x-button.primary type="submit">Update</x-button.primary>
      </div>

    </form>
  </x-card>
</div>
