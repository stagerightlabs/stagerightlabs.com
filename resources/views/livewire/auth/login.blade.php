@section('title', 'Sign in to your account')
@section('heading', 'Sign in to your account')

<x-card>
  <form wire:submit.prevent="authenticate">

    <div>
      <x-form.text
        label="E-Mail"
        type="email"
        id="email"
        name="email"
        wire:model.lazy="email"
        :error="$errors->first('email')"
        :autofocus="true"
      />
    </div>

    <div class="mt-6">
      <x-form.text
        label="Password"
        type="password"
        id="password"
        name="password"
        wire:model.lazy="password"
        :required="true"
      />
    </div>

    <div class="flex items-center justify-between mt-6">
      <div class="flex items-center">
        <input
          wire:model.lazy="remember"
          id="remember"
          type="checkbox"
          class="form-checkbox w-4 h-4 text-red-800 transition duration-150 ease-in-out bg-cool-gray-700 border border-cool-gray-600"
        />
        <label for="remember" class="block ml-2 text-sm text-cool-gray-300 leading-5">
          Remember
        </label>
      </div>

      <div class="text-sm leading-5">
        <a
          href="{{ route('password.request') }}"
          class="font-medium text-red-800 hover:text-red-700 focus:outline-none focus:underline transition ease-in-out duration-150"
        >
          Forgot your password?
        </a>
      </div>
    </div>

    <div class="mt-6">
      <x-button.primary type="submit" :full="true">Sign In</x-button.primary>
    </div>
  </form>
</x-card>
