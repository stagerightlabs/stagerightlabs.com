@section('title', 'Reset password')
@section('heading', 'Reset Password')

<x-card>
 @if ($emailSentMessage)
  <div class="rounded-md bg-green-50 p-4">
    <div class="flex">
      <div class="flex-shrink-0">
        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
      </div>

      <div class="ml-3">
        <p class="text-sm leading-5 font-medium text-green-800">
          {{ $emailSentMessage }}
        </p>
      </div>
    </div>
  </div>
@else
<form wire:submit.prevent="sendResetPasswordLink">
  <x-form.text
    label="E-Mail"
    type="email"
    id="email"
    name="email"
    wire:model.lazy="email"
    :error="$errors->first('email')"
  />

  <div class="mt-6">
    <x-button.primary type="submit" wrapper="w-full" class="w-full">
      Send password reset link
    </x-button.primary>
  </div>
</form>
@endif
</x-card>
