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
  <x-header.link url="#" :mobile="$mobile">About</x-header.link>
  <x-header.link url="https://github.com/stagerightlabs/" :mobile="$mobile" target="_blank">
    <span class="inline-flex">
      GitHub
      @svg('heroicon-o-external-link', ['class' => 'h-5 w-5 ml-1'])
    </span>
  </x-header.link>
  <x-header.link url="https://www.linkedin.com/in/rydurham/" :mobile="$mobile" target="_blank">
    <span class="inline-flex">
      LinkedIn
      @svg('heroicon-o-external-link', ['class' => 'h-5 w-5 ml-1'])
    </span>
  </x-header.link>
</nav>
