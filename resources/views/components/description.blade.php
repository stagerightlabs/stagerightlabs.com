@props([
  'label' => null,
])

<div {{ $attributes }}>
  @if ($label)
  <dt class="text-sm leading-5 font-medium text-cool-gray-400">
    {{ $label }}
  </dt>
  @endif
  <dd class="mt-1 text-sm leading-5 text-cool-gray-300">
    {{ $slot }}
  </dd>
</div>
