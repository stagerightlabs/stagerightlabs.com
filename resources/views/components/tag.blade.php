@props([
  'active' => false,
])

@php
  $attributes = $attributes->merge(['class' => 'inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5 text-cool-gray-800 ml-1 mb-1']);

  if ($active) {
    $attributes = $attributes->merge(['class' => 'bg-cool-gray-300']);
  } else {
    $attributes = $attributes->merge(['class' => 'bg-cool-gray-400 hover:bg-cool-gray-300']);
  }
@endphp

<span {{ $attributes }}>
  {{ $slot }}
</span>
