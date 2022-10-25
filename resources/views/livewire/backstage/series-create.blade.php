@section('title', 'Create Series')

<form wire:submit.prevent="store">
  <x-heading>
    Create Series
    <x-slot name="options">
      <x-button.secondary
        url="{{ route('backstage.series.index') }}"
        icon="heroicon-s-backward"
        class="mr-2"
      >Cancel</x-button.secondary>
      <x-button.primary type="submit">Save</x-button.primary>
    </x-slot>
  </x-heading>
  <x-alert.tray :messages="$messages" class="mb-4" />
  <x-card>

    <x-form.text
      class="col-span-1"
      :error="$errors->first('name')"
      label="Name"
      type="text"
      wire:model.lazy="name"
    />

    <x-form.textarea
      class="resize-y font-mono"
      label="Description"
      :error="$errors->first('description')"
      rows="5"
      wire:model.lazy="description"
      wrapper="mt-4"
    />

    <div class="flex justify-center mt-4">
      <x-button.primary type="submit">Save</x-button.primary>
    </div>
  </x-card>
</form>
