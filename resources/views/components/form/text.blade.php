@props([
  'type' => 'text',
  'label' => '',
  'message' => '',
  'error' => '',
  'disabled' => false,
  'required' => false,
  'autofocus' => false,
])

@php
  $id = $id ?? \App\Utilities\Str::kebab($label) . '-input';
  $attributes = $attributes->merge(['class' => 'rounded-md block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 bg-cool-gray-700 border border-cool-gray-600 focus:ring-cool-gray-400 focus:border-cool-gray-400']);

  if ($error) {
    $attributes = $attributes->merge(['class' => 'pr-10 border-red-700 text-red-700 placeholder-red-300 focus:ring-red-700']);
  }

  if ($disabled) {
    $attributes = $attributes->merge(['class' => 'bg-gray-50']);
  }

  $wrapper = $attributes->filter(function($v, $k) {
    return $k == 'wrapper';
  });

  $wrapper = $wrapper->merge(['class' => $attributes->get('wrapper')]);
  $wrapper->offsetUnset('wrapper');

  $attributes = $attributes->filter(function($v, $k) {
    return $k != 'wrapper';
  });
@endphp

<div {{ $wrapper }}>
  @if ($label)
    <label for="{{ $id }}" class="block text-sm font-medium leading-5 text-cool-gray-300">
      {{ $label }}
    </label>
  @endif

  <div class="mt-1 relative rounded-md shadow-sm">
    <input
      id="{{ $id }}"
      type="{{ $type }}"
      {{ $attributes }}
      aria-describedby="{{ $id }}-error"
      @if ($error)
        aria-invalid="true"
      @endif
      @if ($disabled)
        disabled="disabled"
      @endif
      @if ($required)
        required="required"
      @endif
      @if ($autofocus)
        autofocus="autofocus"
      @endif
    />
    @if ($error)
    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
      <svg class="h-5 w-5 text-red-800" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
      </svg>
    </div>
    @endif
  </div>
  @if ($error)
    <p class="mt-2 text-sm text-red-600" id="{{ $id }}-error">
      {{ $error }}
    </p>
  @endif
  @if ($message)
    <p class="mt-2 text-sm text-gray-500">
      {{ $message }}
    </p>
  @endif
</div>
