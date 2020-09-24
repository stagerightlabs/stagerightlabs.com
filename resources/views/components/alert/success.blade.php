@props([
  'dismissable' => false,
  'id' => '',
  'linkText' => '',
  'message' => '',
  'session' => false,
  'url' => '',
])

<x-alert.base
  :class="'bg-green-300 p-4 border border-green-400 text-green-700 ' . $attributes->get('class', '')"
  :dismissable="$dismissable"
  icon="heroicon-s-check-circle"
  :id="$id"
  :linkText="$linkText"
  :message="$message"
  :session="$session"
  :url="$url"
/>
