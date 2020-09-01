@props([
  'type' => 'link',
  'url' => '#',
  'disabled' => false,
  'icon' => null,
  'target' => null,
  'loading' => false,
  'hover' => 'hover:bg-cool-gray-400 hover:text-cool-gray-600 active:bg-red-700',
  'full' => false,
])

<x-button.base
  class="text-cool-gray-300 bg-cool-gray-500"
  :type="$type"
  :url="$url"
  :disabled="$disabled"
  :icon="$icon"
  :target="$target"
  :loading="$loading"
  :hover="$hover"
  :full="$full"
>{{ $slot }}</x-button.base>
