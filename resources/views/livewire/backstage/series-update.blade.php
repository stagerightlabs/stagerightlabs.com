@section('title', 'Create Series')

<form wire:submit.prevent="update">
  <x-heading>
    Update Series
    <x-slot name="options">
      <x-button.secondary
        url="{{ route('backstage.series.show', $this->series->reference_id) }}"
        icon="heroicon-s-rewind"
        class="mr-2"
      >Cancel</x-button.secondary>
      <x-button.primary type="submit">Save</x-button.primary>
    </x-slot>
  </x-heading>
  <x-alert.tray :messages="$messages" class="mb-4" />
  <x-card>

    <x-form.text
      class="col-span-1"
      :error="$errors->first('series.name')"
      label="Name"
      type="text"
      wire:model.lazy="series.name"
    />

    <x-form.text
      class="col-span-1"
      :error="$errors->first('series.slug')"
      label="Slug"
      type="text"
      wire:model.lazy="series.slug"
      wrapper="mt-4"
    />

    <x-form.textarea
      class="resize-y font-mono"
      label="Content"
      :error="$errors->first('series.description')"
      rows="5"
      wire:model.lazy="series.description"
      wrapper="mt-4"
    />

    <div class="flex justify-center mt-4">
      <x-button.primary type="submit">Save</x-button.primary>
    </div>
  </x-card>
</form>
