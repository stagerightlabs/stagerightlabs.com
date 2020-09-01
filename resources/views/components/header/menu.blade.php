@props([
  'mobile' => false
])

@php
  if ($mobile) {
    $attributes = $attributes->merge(['class' => 'space-y-2']);
  } else {
    $attributes = $attributes->merge(['class' => 'space-x-4']);
  }
@endphp

<nav {{ $attributes }}>
  <x-header.link url="/" :mobile="$mobile">Blog</x-header.link>
  <x-header.link url="#" :mobile="$mobile">Open Source</x-header.link>
  <x-header.link url="#" :mobile="$mobile">Decks</x-header.link>
  <x-header.link url="#" :mobile="$mobile">Contact</x-header.link>
  <x-header.link url="#" :mobile="$mobile">About</x-header.link>
</nav>
