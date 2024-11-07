@props([
  'active' => false,
  'hover' => true,
])

@php
  $attributes = $attributes->merge(['class' => 'inline-flex items-center px-3 py-2 rounded-full text-lg font-normal leading-5 text-zinc-800 ml-1 mb-1']);

  if ($active) {
    $attributes = $attributes->merge(['class' => 'bg-zinc-300']);
  } else {
     $attributes = $attributes->merge(['class' => 'bg-zinc-400']);
  }

  if (!$active && $hover) {
    $attributes = $attributes->merge(['class' => 'hover:bg-zinc-300']);
  }
@endphp

<span {{ $attributes }}>
  {{ $slot }}
</span>
