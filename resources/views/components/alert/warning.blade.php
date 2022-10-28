@props([
  'dismissable' => false,
  'id' => '',
  'linkText' => '',
  'message' => '',
  'session' => false,
  'url' => '',
])

<x-alert.base
  :class="'bg-yellow-100 p-4 border border-yellow-200 text-yellow-600 ' . $attributes->get('class', '')"
  :dismissable="$dismissable"
  icon="heroicon-s-exclamation-triangle"
  :id="$id"
  :linkText="$linkText"
  :message="$message"
  :session="$session"
  :url="$url"
/>
