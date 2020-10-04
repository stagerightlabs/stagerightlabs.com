@section('title', 'Create New Tag')

<div>
  <x-heading>
    Create Tag
    <x-slot name="options">
      <x-button.secondary
        url="{{ route('backstage.tags.index') }}"
        icon="heroicon-s-rewind"
      >Cancel</x-button.primary>
    </x-slot>
  </x-heading>
  <x-alert.tray :messages="$messages" class="mb-4" />
  <x-card>
    <form wire:submit.prevent="store">

      <div class="grid grid-cols-1 gap-4">
        <x-form.text
          class="col-span-1"
          :error="$errors->first('name')"
          label="Name"
          type="text"
          wire:model.lazy="name"
        />
      </div>

      <div class="flex justify-center mt-4">
        <x-button.primary type="submit">Save</x-button.primary>
      </div>

    </form>
  </x-card>
</div>
