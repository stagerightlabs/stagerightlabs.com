@section('title', 'Confirm your password')
@section('heading', 'Confirm Your Password')

<form wire:submit.prevent="confirm">

  <x-form.text
    label="Password"
    type="password"
    id="password"
    name="password"
    wire:model.lazy="password"
    :error="$errors->first('password')"
  />

  <div class="flex items-center justify-end mt-6">
    <div class="text-sm leading-5">
      <a
        href="{{ route('password.request') }}"
        class="font-medium text-red-800 hover:text-red-700 focus:outline-none focus:underline transition ease-in-out duration-150"
      >
        Forgot your password?
      </a>
    </div>
  </div>

  <x-button.primary type="submit" wrapper="w-full mt-6" class="w-full">
    Confirm Password
  </x-button.primary>
</form>
