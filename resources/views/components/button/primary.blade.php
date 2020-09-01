@props([
  'type' => 'link',
  'url' => '#',
  'disabled' => false,
  'icon' => null,
  'target' => null,
  'loading' => false,
  'hover' => 'hover:bg-red-700 hover:text-cool-gray-800 active:bg-red-700',
  'full' => false,
])

<x-button.base
  class="text-cool-gray-300 bg-red-800"
  :type="$type"
  :url="$url"
  :disabled="$disabled"
  :icon="$icon"
  :target="$target"
  :loading="$loading"
  :hover="$hover"
  :full="$full"
>{{ $slot }}</x-button.base>
