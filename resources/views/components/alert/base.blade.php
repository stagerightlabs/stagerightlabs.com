@props([
  'dismissable' => false,
  'icon' => null,
  'id' => '',
  'linkText' => null,
  'message' => '',
  'session' => false,
  'url' => '',
])

<div
  {{ $attributes->merge(['class' => 'rounded-md']) }}
  x-data="{ open:true }"
  x-show="open"
  data-id="message-{{ $id }}"
>
  <div class="flex">
    <div class="shrink-0">
      @if ($icon)
        @svg($icon, ['class' => 'h-5 w-5'])
      @endif
    </div>
    <div class="ml-3 flex-1 md:flex md:justify-between">
      <p class="text-sm leading-5">
        {{ $message }}
        @if ($url)
        <a
          href="{{ $url }}"
          class="whitespace-nowrap font-bold"
        >
          @if ($linkText)
            {{ $linkText }}
          @else
            Click here.
          @endif
        </a>
        @endif
      </p>
    </div>
    @if ($dismissable)
    <div class="ml-auto pl-3">
      <div class="-mx-1.5 -my-1.5">
        <button
          type="button"
          class="inline-flex rounded-md p-1.5"
          @if(isset($_instance) && ! $session)
            @click.once="@this.call('removeAlert', '{{ $id }}')"
          @else
            @click="open = false"
          @endif
        >
          @svg('heroicon-s-x', ['class' => 'h-5 w-5 fill-current'])
        </button>
      </div>
    </div>
    @endif
  </div>
</div>
