@section('title', 'Reset password')
@section('heading', 'Reset Password')

<x-card>
  <form wire:submit.prevent="resetPassword">
    <input wire:model="token" type="hidden">

    <x-form.text
      label="Emal Address"
      type="email"
      id="email"
      type="email"
      wire:model.lazy="email"
      :required="true"
      :autofocus="true"
    />

    <x-form.text
      label="Password"
      type="password"
      id="password"
      wire:model.lazy="password"
      :required="true"
      wrapper="mt-6"
    />

    <x-form.text
      label="Confirm Password"
      type="password"
      id="password_confirmation"
      wire:model.lazy="passwordConfirmation"
      :required="true"
      wrapper="mt-6"
    />

    <div class="mt-6">
      <x-button.primary
        type="submit"
        wrapper="w-full"
        class="w-full"
      >Reset Password</x-button.primary>
    </div>
  </form>
</x-card>
