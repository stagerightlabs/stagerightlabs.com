@props([
  'shortcode' => ''
])

@if ($shortcode)
<div x-data="{copied: false}">
  <code
    @click="
      copyToClipboard($event.target.getAttribute('data-shortcode'));
      window.setTimeout(() => { copied = false;}, 500);
      copied = true
    "
    class="cursor-pointer"
    data-shortcode="{{ $shortcode }}"
  >{{ $shortcode }}</code>
  <span
    x-show="copied"
    class="text-cool-gray-500"
    x-transition:enter="transition ease-out duration-75"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
  >copied</span>
</div>
@endif
