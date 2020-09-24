@props(['hover' => true])

@php
  if ($hover) {
    $attributes = $attributes->merge(['class' => 'hover:bg-cool-gray-500']);
  }
@endphp

<tr {{ $attributes }}>
  {{ $slot }}
</tr>
