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
          class="w-4 h-4 text-red-800 transition duration-150 ease-in-out bg-cool-gray-700 border border-cool-gray-600 focus:ring-cool-gray-400 focus:border-cool-gray-400 rounded"
        />
        <label for="remember" class="block ml-2 text-sm text-cool-gray-300 leading-5">
          Remember
        </label>
      </div>

      <div class="text-sm leading-5">
        <a
          href="{{ route('password.request') }}"
          class="font-medium text-red-700 hover:text-red-600 focus:outline-none focus:underline transition ease-in-out duration-150"
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
