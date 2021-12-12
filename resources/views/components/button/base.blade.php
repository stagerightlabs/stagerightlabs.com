@props([
  'type' => 'link',
  'url' => '#',
  'disabled' => false,
  'icon' => null,
  'target' => null,
  'loading' => false,
  'hover' => '',
  'full' => false,
  'wrapper' => ''
])

@php
  // General Styles
  $attributes = $attributes->merge([
    'class' => 'inline-flex items-center justify-center px-4 py-2 rounded-md
                border border-transparent
                text-sm leading-5 font-medium
                focus:outline-none focus:border-red-700 focus:ring-red
                transition ease-in-out duration-150 '
  ]);

  // Should we display at full width?
  $attributes = $full ? $attributes->merge(['class' => 'w-full']) : $attributes;

  // Has the button been disabled?
  $attributes = $disabled
    ? $attributes->merge(['class' => 'opacity-50 cursor-not-allowed hover:text-current'])
    : $attributes->merge(['class' => $hover]);

  // Pull out the 'wrapper' attributes
  $wrapper = $attributes->filter(function($v, $k) {
    return $k == 'wrapper';
  })->merge(['class' => $wrapper]);

  // Should the wrapper be set to full width?
  $wrapper = $full ? $wrapper->merge(['class' => 'w-full']) : $wrapper;

@endphp

<span {{ $wrapper->merge(['class' => 'inline-flex rounded-md shadow-sm']) }}>
  @if ($type != 'link')
  <button
    type="{{ $type }}"
    @if ($disabled)
      disabled="disabled"
      aria-disabled="true"
    @endif
    {{ $attributes }}
  >
  @else
  <a
    target="{{ $target }}"
    @if($disabled)
      disabled="disabled"
      aria-disabled="true"
    @else
      href="{{ $url }}"
    @endif
    {{ $attributes }}
  >
  @endif
    @if ($icon)
      @svg($icon, ['class' => '-ml-1 mr-1 h-5 w-5 shrink-0'])
    @else
      <span class="block h-5" aria-hidden="true"></span>
    @endif
    <span class="text-left">{{ $slot }}</span>
  @if ($type != 'link')
    </button>
  @else
    </a>
  @endif
</span>
