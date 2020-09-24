@props([
  'disabled' => false,
  'full' => false,
  'hover' => 'hover:bg-cool-gray-400 hover:text-cool-gray-600 active:bg-red-700',
  'icon' => null,
  'loading' => false,
  'target' => null,
  'type' => 'link',
  'url' => '#',
  'wrapper' => '',
])

<x-button.base
  class="text-cool-gray-300 bg-cool-gray-500"
  :disabled="$disabled"
  :full="$full"
  :hover="$hover"
  :icon="$icon"
  :loading="$loading"
  :target="$target"
  :type="$type"
  :url="$url"
  :wrapper="$wrapper"
>{{ $slot }}</x-button.base>
