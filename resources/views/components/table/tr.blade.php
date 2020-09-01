@props(['hover' => true])

@php
  if ($hover) {
    $attributes = $attributes->merge(['class' => 'hover:bg-gray-50']);
  }
@endphp

<tr {{ $attributes }}>
  {{ $slot }}
</tr>
