@extends('layouts.app')

@section('content')
<x-card heading="Primary Buttons" class="mb-8">
  <div class="w-full">
    <x-button.primary url="#">Link</x-button.primary>
    <x-button.primary type="button">Button</x-button.primary>
    <x-button.primary url="#" :disabled="true">Link - Disabled</x-button.primary>
    <x-button.primary type="button" :disabled="true">Button - Disabled</x-button.primary>
  </div>
  <div class="w-full mt-4">
    <x-button.primary url="#" icon="heroicon-s-user">Link</x-button.primary>
    <x-button.primary type="button" icon="heroicon-o-user">Button</x-button.primary>
    <x-button.primary url="#" :disabled="true" icon="heroicon-o-user">Link - Disabled</x-button.primary>
    <x-button.primary type="button" :disabled="true" icon="heroicon-s-user">Button - Disabled</x-button.primary>
  </div>
  <div class="w-full mt-4 grid grid-cols-1 sm:grid-cols-4 gap-4">
    <div class="col-span-1">
      <x-button.primary url="#" icon="heroicon-s-user" :full="true">Link</x-button.primary>
    </div>
    <div class="col-span-1">
      <x-button.primary type="button" icon="heroicon-o-user" :full="true">Button</x-button.primary>
    </div>
    <div class="col-span-1">
      <x-button.primary url="#" :disabled="true" icon="heroicon-o-user" :full="true">Link - Disabled</x-button.primary>
    </div>
    <div class="col-span-1">
      <x-button.primary type="button" :disabled="true" icon="heroicon-s-user" :full="true">Button - Disabled</x-button.primary>
    </div>
  </div>
</x-card>

<x-card heading="Secondary Buttons" class="mb-8">
  <div class="w-full">
    <x-button.secondary url="#">Link</x-button.secondary>
    <x-button.secondary type="button">Button</x-button.secondary>
    <x-button.secondary url="#" :disabled="true">Link - Disabled</x-button.secondary>
    <x-button.secondary type="button" :disabled="true">Button - Disabled</x-button.secondary>
  </div>
  <div class="w-full mt-4">
    <x-button.secondary url="#" icon="heroicon-s-user">Link</x-button.secondary>
    <x-button.secondary type="button" icon="heroicon-o-user">Button</x-button.secondary>
    <x-button.secondary url="#" :disabled="true" icon="heroicon-o-user">Link - Disabled</x-button.secondary>
    <x-button.secondary type="button" :disabled="true" icon="heroicon-s-user">Button - Disabled</x-button.secondary>
  </div>
  <div class="w-full mt-4 grid grid-cols-1 sm:grid-cols-4 gap-4">
    <div class="col-span-1">
      <x-button.secondary url="#" icon="heroicon-s-user" :full="true">Link</x-button.secondary>
    </div>
    <div class="col-span-1">
      <x-button.secondary type="button" icon="heroicon-o-user" :full="true">Button</x-button.secondary>
    </div>
    <div class="col-span-1">
      <x-button.secondary url="#" :disabled="true" icon="heroicon-o-user" :full="true">Link - Disabled</x-button.secondary>
    </div>
    <div class="col-span-1">
      <x-button.secondary type="button" :disabled="true" icon="heroicon-s-user" :full="true">Button - Disabled</x-button.secondary>
    </div>
  </div>
</x-card>

<x-card heading="Alerts" class="mb-8">
  <x-alert.success
    class="mb-4"
    :dismissable="true"
    linkText="CTA"
    message="This is a success message."
    :session="false"
    url="#"
  />
  <x-alert.error
    class="mb-4"
    :dismissable="true"
    message="This is an error message."
    :session="false"
    url="#"
  />
  <x-alert.info
    class="mb-4"
    :dismissable="true"
    message="This is an info message."
    :session="false"
    url="#"
  />
  <x-alert.warning
    class="mb-4"
    :dismissable="true"
    message="This is a warning message."
    :session="false"
    url="#"
  />
</x-card>
@endsection
