@props(['hover' => true])

@php
  if ($hover) {
    $attributes = $attributes->merge(['class' => 'hover:bg-zinc-500']);
  }
@endphp

<tr {{ $attributes }}>
  {{ $slot }}
</tr>
