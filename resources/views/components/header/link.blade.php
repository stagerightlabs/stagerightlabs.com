@props([
  'label',
  'url' => '#',
  'mobile' => false,
  'target' => null,
])

@php
  $active = \Illuminate\Support\Str::startsWith(request()->url(), $url) && $url != '#';

  if ($mobile && $active) {
    $attributes = $attributes->merge([
      'class' => 'block px-3 py-2 rounded-md text-base font-medium text-cool-gray-200 bg-gray-900
                  focus:outline-none focus:text-cool-gray-200 focus:bg-gray-700 transition
                  duration-150 ease-in-out hover:text-white'
    ]);
  } elseif ($mobile && ! $active) {
    $attributes = $attributes->merge([
      'class' => 'block px-3 py-2 rounded-md text-base font-medium text-cool-gray-300 hover:text-white
                  hover:bg-gray-600 focus:outline-none focus:text-white focus:bg-gray-700 transition
                  duration-150 ease-in-out'
    ]);
  } elseif ($active) {
    $attributes = $attributes->merge([
      'class' => 'px-3 py-2 rounded-md text-sm leading-5 font-medium text-white bg-gray-900
                  focus:outline-none focus:text-white focus:bg-gray-700 transition
                  duration-150 ease-in-out'
    ]);
  } else {
    $attributes = $attributes->merge([
      'class' => 'px-3 py-2 rounded-md text-sm leading-5 font-medium text-gray-300 hover:text-white
                  hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition
                  duration-150 ease-in-out'
    ]);
  }
@endphp

<a
  href="{{ $url }}"
  {{ $attributes }}
  @if ($target)
  target="{{ $target }}"
  @endif
>
  {{ $slot }}
</a>
