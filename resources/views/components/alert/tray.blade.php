@props([
  'messages' => [],
  'session' => false,
])

<div x-data {{ $attributes }}>
  @foreach($messages as $message)

    @if($message['type'] == 'info')
      <x-alert.info
        class="mb-2"
        :dismissable=" true"
        :id="$message['id']"
        :link-text=" $message['link'] ?? ''"
        :message="$message['text']"
        :session="$session"
        :url=" $message['url'] ?? ''"
        wire:key="{{ $message['id'] }}"
      />
    @endif

    @if($message['type'] == 'warning')
      <x-alert.warning
        class="mb-2"
        :dismissable=" true"
        :id="$message['id']"
        :link-text=" $message['link'] ?? ''"
        :message="$message['text']"
        :session="$session"
        :url=" $message['url'] ?? ''"
        wire:key="{{ $message['id'] }}"
      />
    @endif

    @if($message['type'] == 'error')
      <x-alert.error
        class="mb-2"
        :dismissable=" true"
        :id="$message['id']"
        :link-text=" $message['link'] ?? ''"
        :message="$message['text']"
        :session="$session"
        :url=" $message['url'] ?? ''"
        wire:key="{{ $message['id'] }}"
      />
    @endif

    @if($message['type'] == 'success')
      <x-alert.success
        class="mb-2"
        :dismissable=" true"
        :id="$message['id']"
        :link-text=" $message['link'] ?? ''"
        :message="$message['text']"
        :session="$session"
        :url=" $message['url'] ?? ''"
        wire:key="{{ $message['id'] }}"
      />
    @endif

  @endforeach
</div>
