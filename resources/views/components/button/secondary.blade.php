@props([
  'disabled' => false,
  'full' => false,
  'hover' => 'hover:bg-zinc-400 hover:text-zinc-600 active:bg-red-700',
  'icon' => null,
  'loading' => false,
  'target' => null,
  'type' => 'link',
  'url' => '#',
  'wrapper' => '',
])

<x-button.base
  :disabled="$disabled"
  :full="$full"
  :hover="$hover"
  :icon="$icon"
  :loading="$loading"
  :target="$target"
  :type="$type"
  :url="$url"
  :wrapper="$wrapper"
  {{ $attributes->merge(['class' => 'text-zinc-300 bg-zinc-500']) }}
>{{ $slot }}</x-button.base>
