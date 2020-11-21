@props([
  'type' => 'text',
  'label' => '',
  'message' => '',
  'error' => '',
  'disabled' => false,
  'required' => false,
  'autofocus' => false,
  'cols' => 20,
  'rows' => 3,
])

@php
  $id = $id ?? \App\Utilities\Str::kebab($label) . '-input';
  $attributes = $attributes->merge(['class' => 'rounded-md block w-full transition duration-150 ease-in-out sm:leading-5 bg-cool-gray-700 border border-cool-gray-600 focus:ring-cool-gray-400 focus:border-cool-gray-400']);

  if ($error) {
    $attributes = $attributes->merge(['class' => 'pr-10 border-red-700 text-red-700 placeholder-red-300 focus:border-red-700 focus:ring-red']);
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
    <textarea
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
      rows="{{ $rows }}"
      cols="{{ $cols }}"
    ></textarea>
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
